<?php
include_once('config.php');

function load_age($value)
{

    $sql="select * from tbl_age_group";
    $query=mysql_query($sql);
    echo '<option value="Select Age">Select Age</option>';
    while($age_array=mysql_fetch_array($query))
    {
        echo '<option value="';
        echo $age_array['age_range'].'"';
        if($value==$age_array['age_range'])
        {
            echo 'selected="true"';
        }
        echo '>'.$age_array['age_range'].'</option>';
    }
}
function load_country($value)
{
    $sql="select * from tbl_countries_list";
    $query=mysql_query($sql);
    echo '<option value="Select Country">Select Country</option>';
    while($country_array=mysql_fetch_array($query))
    {
        echo '<option value="';
        echo $country_array['country_desc'].'"';

            if($value==$country_array['country_desc'])
            {
                echo 'selected="true"';
            }
        echo '>'.$country_array['country_desc'].'</option>';
    }
}
?>