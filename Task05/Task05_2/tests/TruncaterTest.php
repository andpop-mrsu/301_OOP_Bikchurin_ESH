<?php

namespace App\Tests;

use App\src\Truncater;
use PHPUnit\Framework\TestCase;

class TruncaterTest extends TestCase
{
    public function testNoTruncationNeeded(): void
    {
        $truncater = new Truncater();
        $input = 'Short text';
        $this->assertSame($input, $truncater->truncate($input, 20));
    }

    public function testBasicTruncationWithDefaultSeparator(): void
    {
        $truncater = new Truncater();
        $this->assertSame('Hello...', $truncater->truncate('Hello world', 5));
    }

    public function testCustomSeparatorUsage(): void
    {
        $truncater = new Truncater('--');
        $result = $truncater->truncate('Test string here', 4);
        $this->assertSame('Test--', $result);
    }

    public function testConfigureChangesSeparator(): void
    {
        $truncater = new Truncater();
        $truncater->configure(['separator' => '!!!']);
        $this->assertSame('He!!!', $truncater->truncate('Hello', 2));
    }

    public function testTruncationRespectsMultibyteCharacters(): void
    {
        $truncater = new Truncater();
        $result = $truncater->truncate('Привет мир', 6);
        $this->assertSame('Привет...', $result);
    }

    public function testZeroLimitResultsInOnlySeparator(): void
    {
        $truncater = new Truncater('~');
        $result = $truncater->truncate('Non-empty', 0);
        $this->assertSame('~', $result);
    }
}
