<?php


if ( ! function_exists('pre'))
{
	function pre($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}	
}


if ( ! function_exists('esc')) //alias: mysql_real_escape_string()
{
	function esc($string)
	{
		$result=mysql_real_escape_string(trim($string));
		return $result;
	}	
}

if ( ! function_exists('start_precedence'))
{
	function start_precedence($table,$coloum, $id)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$coloum.' = '.$id.'  order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('end_precedence'))
{
	function end_precedence($table, $coloum, $id)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$coloum.' = '.$id.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence'))
{
	function first_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence asc'));
		return $result['precedence'];
	}	
}



if ( ! function_exists('last_precedence'))
{
	function last_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('precedence_by'))
{
	function precedence_by($table, $coloum, $id)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$coloum.' = '.$id.'  order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('cat_precedence'))
{
    function cat_precedence($table, $cat)
    {
        $result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where category_id = '.$cat.' order by precedence desc'));
        return $result['precedence'];
    }   
}

if ( ! function_exists('cat_nilai'))
{
    function cat_nilai($id)
    {
        $result=mysql_fetch_assoc(mysql_query('select category_id from homebanner_tb where id = '.$id));
        return $result['category_id'];
    }   
}

if ( ! function_exists('prec_nilai'))
{
    function prec_nilai($id)
    {
        $result=mysql_fetch_assoc(mysql_query('select precedence from homebanner_tb where id = '.$id));
        return $result['precedence'];
    }   
}

if ( ! function_exists('findImg'))
{
	function findImg($coloumn,$id,$table)
	{
	//	echo "select `".$coloumn."` from `".$table."` where id='".$id."'";
		$q="select `".$coloumn."` from `".$table."` where image='".$id."'";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result[$coloumn];
	}	
}


if ( ! function_exists('find'))
{
	function find($coloumn,$id,$table)
	{
	//	echo "select `".$coloumn."` from `".$table."` where id='".$id."'";
		$q="select `".$coloumn."` from `".$table."` where id='".$id."'";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result[$coloumn];
	}	
}

if ( ! function_exists('first_precedence_2'))
{
	function first_precedence_2($table,$data_1,$data_2)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('last_precedence_2'))
{
	function last_precedence_2($table,$data_1,$data_2)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('make_alias'))
{
	function make_alias($string)
	{
		$string=strtolower($string);
		
		$string=str_replace('&','n',$string);
		
		$string=preg_replace('/[^a-z0-9]/', "-", $string);
		
		$string=ltrim(rtrim($string,'-'),'-');
		
		return $string;
	}	
}

if ( ! function_exists('first_precedence_2'))
{
	function counter($table,$coloum)
	{
		$result=mysql_fetch_assoc(mysql_query('select '.$coloum.' from user_contribution where '.$data_1.' = '.$data_2.' order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('baseCat'))
{
	function baseCat($cat)
	{
		$query = "SELECT * FROM what_near_item_tb where category_what_near_id = '".esc($cat)."'";
		$item = mysql_query($query);
		while ($list = mysql_fetch_assoc($item)) {
			echo '<li><a href="#">'.$list['name'].'</a></li>';
		}
	}	
}

if ( ! function_exists('baseQuestion'))
{
	function baseQuestion($question)
	{
		$query = "SELECT * FROM answer_tb where question_id = '".esc($question)."'";
		$item = mysql_query($query);
		$yes = "puzzle-yes";
		$no = "puzzle-no";
		while ($list = mysql_fetch_assoc($item)) {
			if($list['correct']==1){ 
				echo '<li><a href="javascript:void(0);" class="'.$yes.'">'.$list['answer'].'</a></li>';
			} else {
				echo '<li><a href="javascript:void(0);" class="'.$no.'">'.$list['answer'].'</a></li>';
			}
		}
	}	
}


if ( ! function_exists('get_categorydownline_product2'))
{
    function get_categorydownline_product2($parent)
    {
		$q="select * from `category_tb` where `parent_id`='".esc($parent)."'";
        $category=mysql_query($q);
        if($category){
			//echo "<ul>";
			$counter=1;
        	while ($list = mysql_fetch_assoc($category)) {
				if($counter==1){
					echo "<ul>";
				}
		        /*echo '<li><a href="javaScript:void(0)" data-name="'.$list['name'].'" data-category="'.$list['id'].'" class="category_item">'.$list['name'].'</a>';*/
				echo '<li><label><input type="checkbox" name="category[]" value="'.$list['id'].'" data-name="'.$list['name'].'" data-category="'.$list['id'].'" class="category_item"> '.$list['name'].'</label>';
				get_categorydownline_product2($list['id']);	
				echo "</li>";
				
				$counter++;
			}
			echo "</ul>";
			if($counter>1){
				echo "</ul>";
			}
		}
    }   
}

if ( ! function_exists('counts'))
{
	function counts($coloumn)
	{
		//echo "SELECT COUNT(".$coloumn.") FROM question_tb where ".$coloumn." = 1";
		$q="SELECT COUNT(".$coloumn.") as counter FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'photos' && b.active = 1";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result['counter'];
	}
}

if ( ! function_exists('coun'))
{
	function coun($coloumn)
	{
		//echo "SELECT COUNT(".$coloumn.") FROM question_tb where ".$coloumn." = 1";
		$q="SELECT COUNT(".$coloumn.") as counter FROM update_tb where active=1 AND featured=0";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result['counter'];
	}
}
   
?>