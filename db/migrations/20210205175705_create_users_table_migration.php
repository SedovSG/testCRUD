<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTableMigration extends AbstractMigration
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
        $users = $this->table("users");
        $users->addColumn("fname", "string", ["limit" => 120, "comment" => "Имя пользователя"])
              ->addColumn("lname", "string", ["limit" => 160, "comment" => "Фамилия пользователя"])
              ->addColumn("mname", "string", [
                "limit" => 160, "comment" => "Отчество пользователя", "null" => true
              ])->addIndex(["fname", "lname"])->save();

        $users->changeComment("Таблица пользователей")->update();
    }

    public function down()
    {
        $this->table("users")->drop();
    }
}
