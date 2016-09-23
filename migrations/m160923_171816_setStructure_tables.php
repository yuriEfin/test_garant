<?php
use yii\db\Migration;

class m160923_171816_setStructure_tables extends Migration
{

    public function up()
    {
        $tables = [
            [
                'name' => '{{%calculation}}',
                'columns' => [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(255),
                    'text' => $this->text(),
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime(),
                ],
                'index' => [
                    'xtitle' => 'title', // для выборке по наименованию
                    'xdate' => ['created_at', 'updated_at'], // для сортирвкам по датам 
                ],
            ],
            [
                'name' => '{{%calculation_code}}',
                'columns' => [
                    'id' => $this->primaryKey(), // больше для самого Yii - для CRUD 
                    'calculation_id' => $this->integer(11),
                    'code' => $this->decimal(),
                ],
                'index' => [
                    'xmix' => ['calculation_id', 'code'], // составной потому что будем юзать calculation_id = n AND code = xxxx
                ],
            ],
        ];

        foreach ($tables as $table) {
            extract($table);
            if (!$this->db->getTableSchema($name)) {
                $this->createTable($name, $columns);
                if (isset($index)) {
                    foreach ($index as $xname => $columnList) {
                        $this->createIndex($xname, $name, $columnList);
                    }
                }
            }
        }
    }

    public function down()
    {
        $tables = [
            '{{%calculation}}',
            '{{%calculation_code}}',
        ];
        foreach ($tables as $t) {
            if ($this->db->getTableSchema($t)) {
                $this->dropTable($t);
            }
        }
    }
}
