<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateModelsCommand extends Command
{
    protected $signature = 'models:create';

    protected $description = 'Create models for database tables';

    public function handle()
    {
        $tables = $this->getTables();

        foreach ($tables as $table) {
            $this->createModel($table);
        }

        $this->info('Models created successfully!');
    }

    protected function getTables()
    {
        return DB::connection()->getDoctrineSchemaManager()->listTableNames();
    }

    protected function createModel($table)
    {
        // $table =$tables->Tables_in_soili;
        $modelName = $this->getModelName($table);
        $className = $modelName . '.php';
        $filePath = app_path('Models/' . $className);

        if (!file_exists($filePath)) {
            $stub = $this->generateModelStub($modelName, $table);
            file_put_contents($filePath, $stub);
        }
    }

    protected function getModelName($table)
    {
        return \Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($table));
    }

    protected function generateModelStub($modelName, $table)
    {
        $relationships = $this->getRelationships($table);

        $stub = "<?php\n\n";
        $stub .= "namespace App\Models;\n\n";
        $stub .= "use Illuminate\Database\Eloquent\Model;\n\n";
        $stub .= "class $modelName extends Model\n";
        $stub .= "{\n";
        $stub .= "    protected \$table = '$table';\n";
        $stub .= "    protected \$primaryKey = '" . $this->getPrimaryKey($table) . "';\n";
        $stub .= "    public \$timestamps = false;\n";
        $stub .= "    protected \$fillable = " . $this->getFillableColumns($table) . ";\n\n";
        $stub .= $relationships . "\n";
        $stub .= "}\n";

        return $stub;
    }

    protected function getRelationships($table)
    {
        $relationships = "";

        $foreignKeys = DB::connection()->getDoctrineSchemaManager()->listTableForeignKeys($table);

        foreach ($foreignKeys as $foreignKey) {
            $foreignTable = $foreignKey->getForeignTableName();
            $localColumn = $foreignKey->getLocalColumns()[0];
            $foreignColumn = $foreignKey->getForeignColumns()[0];

            $modelName = $this->getModelName($foreignTable);
            $relationship = \Illuminate\Support\Str::camel($modelName);

            $relationships .= "    public function $relationship()\n";
            $relationships .= "    {\n";
            $relationships .= "        return \$this->belongsTo($modelName::class, '$foreignColumn', '$localColumn');\n";
            $relationships .= "    }\n\n";
        }

        return $relationships;
    }

    protected function getPrimaryKey($table)
    {
        // $primaryKey = Schema::getConnection()->getDoctrineSchemaManager()->listTableDetails($table)->getPrimaryKey();

        return 'id';
    }

    protected function getFillableColumns($table)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, [$this->getPrimaryKey($table)]);
        $fillable = "'" . implode("', '", $columns) . "'";

        return '[' . $fillable . ']';
    }
}
