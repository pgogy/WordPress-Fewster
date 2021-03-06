<?PHP
	
	class fewster_remote_library{
	
		function get_plugin($file = null){
		
			if($file==null){
				$file = $_POST['fewster_file'];
			}
			
			require_once("fewster_library.php");
			$library = new fewster_library;
			
			$dir = wp_upload_dir();
			$plugins_root = str_replace("\\","/", str_replace("uploads","plugins",$dir['basedir']));
			$short_path = str_replace($plugins_root . "/","",$file);
			
			$plugins = get_plugins();
			$parts = explode("/",$short_path);
			$plugin_name = $parts[0];
			
			foreach($plugins as $plugin => $data){
				if(strpos($plugin, $plugin_name . "/")!==FALSE){
					$version = $data['Version'];
					$content = $library->get_url("https://plugins.svn.wordpress.org/" . $plugin_name . "/tags/" . $version . str_replace($plugins_root . "/" . $plugin_name,"",$file));
					if($content[0]['http_code']!=200){
						$content = $library->get_url("https://plugins.svn.wordpress.org/" . $plugin_name . "/trunk" . str_replace($plugins_root . "/" . $plugin_name,"",$file));
						if($content[0]['http_code']!=200){
							return false;
						}
					}
					return $content;
				}
			}
		}
		
		function get_plugin_data($file){
		
			require_once("fewster_library.php");
			$library = new fewster_library;
		
			$parts = explode("/",$file);
			$plugin_name = $parts[0];

			$found = 1;	
			$version = 0;

			$content = $library->get_url("https://plugins.svn.wordpress.org/" . $plugin_name . "/trunk/" . $parts[1]);
			if($content[0]['http_code']!=200){
				$found = 0; 
			}
			$version = explode ("ersion:", $content[1]);
			$number = explode("\r", $version[1]);
			if(count($number)==1){
				$number = explode("\n", $version[1]);
			}
			return array($found,trim($number[0]));
			
		}
		
		function get_theme_data($file){
		
			require_once("fewster_library.php");
			$library = new fewster_library;
		
			$parts = explode("/",$file);
			$theme_name = $parts[0];

			$found = 1;	
			$version = 0;

			$content = $library->get_url("https://themes.svn.wordpress.org/" . $theme_name . "/");
			if($content[0]['http_code']!=200){
				$found = 0; 
			}else{
				$version = explode ("<li>", $content[1]);
				
				$latest = array_pop($version);
				
				$number = explode("</li>", $latest);
				
				$version = strip_tags(str_replace("/","",$number[0]));
			}
			
			return array($found,trim($version));
			
		}

		function get_theme($file = null){
		
			if($file==null){
				$file = $_POST['fewster_file'];
			}
			
			require_once("fewster_library.php");
			$library = new fewster_library;
			$base = get_template_directory();
			
			$themes = wp_get_themes();
			$parts = explode("/",str_replace("\\","/",$base));
			array_pop($parts);
			$base = implode("/", $parts);
			$theme_name = str_replace($base . "/","",$file);
			$theme_name = substr($theme_name,0,strpos($theme_name,"/"));
			
			foreach($themes as $theme => $data){
				if(strpos($theme, $theme_name)!==FALSE){
					$version = $data['Version'];
					$content = $library->get_url("https://themes.svn.wordpress.org/" . $theme_name . "/" . $version . "/" . str_replace($base . "/" . $theme_name . "/","",$file));
					if($content[0]['http_code']!=200){
						$content = $library->get_url("https://themes.svn.wordpress.org/" . $theme_name . "/trunk/" . str_replace($base . "/" . $theme_name . "/","",$file));
						if($content[0]['http_code']!=200){
							return false;
						}
					}
					return $content;
				}
			}
		}	
		
		function get_core($file = null){
		
			if($file==null){
				$file = $_POST['fewster_file'];
			}
			
			require_once("fewster_library.php");
			$library = new fewster_library;
			$base = $library->get_config_path();
			
			global $wp_version;
			
			$content = $library->get_url("https://core.svn.wordpress.org/tags/" . $wp_version . "/" . str_replace($base,"",$file));

			if($content[0]['http_code']!=200){
				return false;
			}
			
			return $content;
		}
		
	}
