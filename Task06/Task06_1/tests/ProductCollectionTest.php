<?php

namespace App\Tests;

use App\Product;
use App\ProductCollection;
use App\ManufacturerFilter;
use App\MaxPriceFilter;
use PHPUnit\Framework\TestCase;

class ProductCollectionTest extends TestCase
{
    private ProductCollection $collection;

    protected function setUp(): void
    {
        $this->collection = new ProductCollection([
            $this->createProduct('Шоколад', 100, 50, 'Красный Октябрь'),
            $this->createProduct('Мармелад', 100, null, 'Ламзурь'),
            $this->createProduct('Зефир', 200, 150, 'Ламзурь'),
            $this->createProduct('Пряник', 80, null, 'Буревестник')
        ]);
    }

    private function createProduct(
        string $name,
        float $listPrice,
        ?float $sellingPrice,
        string $manufacturer
    ): Product {
        $product = new Product();
        $product->name = $name;
        $product->listPrice = $listPrice;
        $product->sellingPrice = $sellingPrice;
        $product->manufacturer = $manufacturer;

        return $product;
    }

    public function testFilterByManufacturerReturnsCorrectProducts(): void
    {
        $filter = new ManufacturerFilter('Ламзурь');
        $filteredCollection = $this->collection->filter($filter);

        $expectedNames = ['Мармелад', 'Зефир'];
        $actualNames = array_map(
            fn(Product $p) => $p->name,
            $filteredCollection->getProductsArray()
        );

        $this->assertCount(2, $filteredCollection);
        $this->assertEqualsCanonicalizing($expectedNames, $actualNames);
    }

    public function testFilterByNonExistentManufacturerReturnsEmptyCollection(): void
    {
        $filter = new ManufacturerFilter('Несуществующий производитель');
        $filteredCollection = $this->collection->filter($filter);

        $this->assertEmpty($filteredCollection->getProductsArray());
    }

    public function testFilterByMaxPriceWithDiscount(): void
    {
        $filter = new MaxPriceFilter(50);
        $filteredCollection = $this->collection->filter($filter);

        $this->assertCount(1, $filteredCollection);
        $this->assertEquals('Шоколад', $filteredCollection->getProductsArray()[0]->name);
    }

    public function testFilterByMaxPriceWithoutDiscount(): void
    {
        $filter = new MaxPriceFilter(80);
        $filteredCollection = $this->collection->filter($filter);

        $expectedNames = ['Шоколад', 'Пряник'];
        $actualNames = array_map(
            fn(Product $p) => $p->name,
            $filteredCollection->getProductsArray()
        );

        $this->assertCount(2, $filteredCollection);
        $this->assertContains('Пряник', $actualNames);
    }

    public function testFilterByMaxPriceEdgeCase(): void
    {
        $filter = new MaxPriceFilter(100);
        $filteredCollection = $this->collection->filter($filter);

        $this->assertCount(2, $filteredCollection);
    }

    public function testFilterCombination(): void
    {
        $manufacturerFilter = new ManufacturerFilter('Ламзурь');
        $filteredByManufacturer = $this->collection->filter($manufacturerFilter);

        $priceFilter = new MaxPriceFilter(120);
        $filteredByBoth = $filteredByManufacturer->filter($priceFilter);

        $this->assertCount(1, $filteredByBoth);
        $this->assertEquals('Мармелад', $filteredByBoth->getProductsArray()[0]->name);
    }
}