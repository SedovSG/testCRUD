<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateObjectsTableMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $objects = $this->table("objects");
        $objects->addColumn("users_id", "integer", ["comment" => "Идентификатор владельца объекта"])
                ->addColumn("name", "text", ["comment" => "Название объекта"])
                ->addColumn("coordinates", "text", ["comment" => "Координаты объекта"])
                ->addColumn("address", "text", ["comment" => "Адрес объекта"])
                ->addColumn("points", "text", ["comment" => "Набор точек, определяющий контур объекта"])
                ->addIndex(["coordinates"], ["unique" => true])
                ->addIndex(["address"])
                ->save();

        $objects->changeComment("Таблица объектов")->update();
    }

    public function down()
    {
        $this->table("objects")->drop()->save();
    }
}
