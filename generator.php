<?php
/**
* Generate the skeleton
*/
class BukkitPluginGenerator
{
	public static $error;
	public static $presets;
	public static $gen;
	private static $input;
	public static $name;

	public function start()
	{
		self::$error = array();
		self::$presets = array();
		//self::$gen = false;
		//self::$input = array();
	}

	public function checkInput($input)
	{
		self::$input = $input;
		//ERROR CHECKING

		if (empty(self::$input['name'])) {
			self::$error[] = 'name';
		}

		if (empty(self::$input['package'])) {
			self::$error[] = 'package';
		}

		if (empty(self::$input['author'])) {
			self::$error[] = 'author';
		}

		if (empty(self::$input['version'])) {
			self::$error[] = 'version';
		}

		if (empty(self::$input['database'])) {
			self::$error[] = 'database';
		}

		if (empty(self::$input['startup'])) {
			self::$error[] = 'startup';
		}

		if (empty(self::$input['class'])) {
			self::$error[] = 'class';
		}

		if (empty(self::$input['description'])) {
			self::$error[] = 'description';
		}

		return self::$error;

	}

	public function addPreset($name, $content)
	{
		$presets[$name] = $content;
	}

	public function setPresets()
	{
		self::$presets['plugin.yml'] = "author: " . self::$input['author'] . "
database: " . self::$input['database'] . "
description: " . self::$input['description'] . "
generator: 
main: " . self::$input['class'] . "
name: " . self::$input['name'] . "
startup: " . self::$input['startup'] . "
url: " . self::$input['website'] . "
version: '" . self::$input['version'] . "'
";

		self::$presets['class.java'] = "package " . self::$input['package'] . "

import org.bukkit.event.EventHandler;
import org.bukkit.event.Listener;
import org.bukkit.event.player.PlayerJoinEvent;
import org.bukkit.plugin.java.JavaPlugin;

public class Test extends JavaPlugin implements Listener {
    public void onDisable() {
        //CODE HERE
    }

    public void onEnable() {
        //MORE CODE HERE
        getServer().getPluginManager().registerEvents(this, this);
    }

    @EventHandler
    public void onPlayerJoin(PlayerJoinEvent event) {
        event.getPlayer().sendMessage(\"Welcome to the server, \" + event.getPlayer().getDisplayName() + \"! Best Regards, the ServerTeam\");
    }
}";
	}

	public function explodePackage($package)
	{
		$package = str_replace('.', '/', $package);
		return $package;
	}

	public function generate()
	{
		self::$input['packageExploded'] = self::explodePackage(self::$input['package']);

		$storage = explode('|', file_get_contents('storage.txt'));
		$gennumber = intval($storage[0]);

		$dirs = array(
			'gens/' . $gennumber . '/' . self::$input['author'],
			'gens/' . $gennumber . '/' . self::$input['author'] . '/src/main/java/' . self::explodePackage(self::$input['package']),
			'gens/' . $gennumber . '/' . self::$input['author'] . '/src/main/resources',
			);

		for ($i=0; $i < count(self::$input['package']['packageExploded']); $i++) { 


		}

		foreach ($dirs as $dir) {
			mkdir($dir, 0777, true);
		}

		file_put_contents($dirs[2] . '/plugin.yml', self::$presets['plugin.yml']);
		file_put_contents($dirs[1] . '/' . self::$input['class'] . '.java', self::$presets['class.java']);



		$storage[0] = $gennumber + 1;
		$storage = implode('|', $storage);  
		file_put_contents('storage.txt', $storage);

		self::$gen = true;

		self::$name = './download/' . self::$input['name'] . '(' . $gennumber . ').zip';
		self::Zip($dirs[0], self::$name);


	}

	function Zip($source, $destination)
	{
	    if (!extension_loaded('zip') || !file_exists($source)) {
	        return false;
	    }

	    $zip = new ZipArchive();
	    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
	        return false;
	    }

	    $source = str_replace('\\', '/', realpath($source));

	    if (is_dir($source) === true)
	    {
	        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

	        foreach ($files as $file)
	        {
	            $file = str_replace('\\', '/', $file);

	            // Ignore "." and ".." folders
	            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
	                continue;

	            $file = realpath($file);

	            if (is_dir($file) === true)
	            {
	                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
	            }
	            else if (is_file($file) === true)
	            {
	                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
	            }
	        }
	    }
	    else if (is_file($source) === true)
	    {
	        $zip->addFromString(basename($source), file_get_contents($source));
	    }

	    return $zip->close();
	}
	
}

