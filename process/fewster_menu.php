<?PHP

	class fewster_menu{
	
		function __construct(){
			add_action("admin_menu", array($this, "menu"));
		}
	
		function menu(){
		
			if(get_option( 'fewster_super_quiet_mode')!="on"){
				global $submenu, $menu;
				
				$submenu['fewster-anti-bad'][7][0]="";
				$submenu['fewster-anti-bad'][7][3]="";
				$submenu['fewster-anti-bad'][8][0]="";
				$submenu['fewster-anti-bad'][8][3]="";
				$submenu['fewster-anti-bad'][9][0]="";
				$submenu['fewster-anti-bad'][9][3]="";
				$submenu['fewster-anti-bad'][10][0]="";
				$submenu['fewster-anti-bad'][10][3]="";
				$submenu['fewster-anti-bad'][12][0]="";
				$submenu['fewster-anti-bad'][12][3]="";
				$submenu['fewster-anti-bad'][13][0]="";
				$submenu['fewster-anti-bad'][13][3]="";
				$submenu['fewster-anti-bad'][14][0]="";
				$submenu['fewster-anti-bad'][14][3]="";
				$submenu['fewster-anti-bad'][15][0]="";
				$submenu['fewster-anti-bad'][15][3]="";			
				$submenu['fewster-anti-bad'][16][0]="";
				$submenu['fewster-anti-bad'][16][3]="";			
				$submenu['fewster-anti-bad'][17][0]="";
				$submenu['fewster-anti-bad'][17][3]="";
				$submenu['fewster-anti-bad'][18][0]="";
				$submenu['fewster-anti-bad'][18][3]="";
				$submenu['fewster-anti-bad'][19][0]="";
				$submenu['fewster-anti-bad'][19][3]="";
				$submenu['fewster-anti-bad'][20][0]="";
				$submenu['fewster-anti-bad'][20][3]="";
				$submenu['fewster-anti-bad'][21][0]="";
				$submenu['fewster-anti-bad'][21][3]="";
				$submenu['fewster-anti-bad'][22][0]="";
				$submenu['fewster-anti-bad'][22][3]="";
				$submenu['fewster-anti-bad'][23][0]="";
				$submenu['fewster-anti-bad'][23][3]="";
				
			}else{
			
				global $submenu, $menu;
				
				foreach($menu as $index => $item){
					if($item[0]=="Fewster Anti-Bad"){
						unset($menu[$index]);
					}
				}	
				
				$submenu['fewster-anti-bad']=null;
			
			}
			
		}
		
	}
	
	$fewster_menu = new fewster_menu();