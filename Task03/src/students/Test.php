<?php

namespace App\students;

class Test
{
    public static function runTest(): void
    {
        echo "Тестирование Student...\n";

        $student1 = new Student("Бикчурин", "Эльмир", "ФМиИТ", 3, "301");
        echo $student1;

        $student2 = (new Student("Иван", "Иванов", "ФМиИТ", 3, "301"))
            ->setSecondName("Сидоров")
            ->setCourse(4);

        echo $student2;

        echo "Тестирование StudentsList...\n";

        $list = new StudentsList();
        $list->add($student1);
        $list->add($student2);

        echo "Всего студентов: " . $list->count() . "\n";
        echo "Первый студент: " . $list->get(0) . "\n";

        $list->store("students.db");
        echo "Данные сохранены в students.db\n";

        $newList = new StudentsList();
        $newList->load("students.db");

        echo "Всего студентов после загрузки: " . $newList->count() . "\n";
    }
}
