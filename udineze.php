<?
include('simple_html_dom.php');
?>
    <form method="post">
        <p>place - team</p>
        <input type="text" name="name" />
        <input type="submit" value="search" />

    </form>
<?php
if ($_POST) {
    $domain = 'https://terrikon.com';
    $html = file_get_html($domain . '/football/italy/championship/archive');

    foreach ($html->find('.tab .news dd a') as $e) {
        $html2 = file_get_html($domain . '/' . $e->href);
        echo 'Parse <b>' . $e->href . '</b><br />';
        foreach ($html2->find('.colored tr') as $e2) {
            if (strpos($e2->plaintext, $_POST['name']) !== false) {
                $str = $e2->plaintext;
                $arr = explode('#', $str);
                $arr2 = explode('.',$arr[0]);
                if(trim($arr2[1]) == trim($_POST['name'])){
                    echo 'место ' . $arr[0] . ' <br />';
                }
            }
        }
        echo '<hr>';
    }
}
?>