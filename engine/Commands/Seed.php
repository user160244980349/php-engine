<?php

namespace Engine\Commands;

use Engine\ITransaction;
use Engine\ServiceBus;

/**
 * Seed.php
 *
 * Command class to upload seeds.
 */
class Seed
{

    /**
     * Create seeds file.
     *
     * @access public.
     * @param string $name
     */
    public static function create(string $name)
    {
        print("creating seed...\n");

        $path = ServiceBus::get('fs_map')->get('seeds');
        $date = date('m_d_Y_H_i_s');
        $name = "{$name}_seed";
        $file = "{$path}/{$name}_{$date}.php";
        $content =
/** @lang php&sql */
<<<EOT
<?php

namespace Database\Seeds;

use Engine\ITransaction;
use Engine\ServiceBus;

/**
 * {$name}_{$date}.php
 *
 * Seeding for ...
 */
class {$name}_{$date} implements ITransaction
{
    
    /**
     * Performs seeding
     *
     */
    public static function commit() {
        ServiceBus::get('database')->fetch("SELECT * FROM `table`");
    }
    
    /**
     * Revert all seeds
     *
     */
    public static function revert() {
        ServiceBus::get('database')->fetch("SELECT * FROM `table`");
    }
}
EOT;
        file_put_contents($file, $content);
        print("seed has been created.\n");
    }

    /**
     * Inserting seeds.
     *
     * @access public.
     */
    public static function do()
    {
        print("uploading seeds...\n");

        $seeds_list = ServiceBus::get('conf')->get('seeds_list');
        foreach ($seeds_list as $seed) {

            if (!in_array(ITransaction::class, class_implements($seed))) {
                return;
            }

            $seed::commit();

            $error = ServiceBus::get('database')->error();
            if ($error[0] != '00000')
                dd($error);

        }

        print("seed has been uploaded.\n");
    }

}
