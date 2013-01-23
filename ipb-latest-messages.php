<?php
define('IPB_FORUM_URL', "http://forum.domain.ru/");
define('IPB_POSTS_COUNT', 15);
define('IPB_TOPIC_MAXLENGTH', 100);
define('IPB_DB_HOST', "localhost");
define('IPB_DB_PREFIX', "");
define('IPB_DB_PREFIX', "");
define('IPB_DB_USERNAME', "");
define('IPB_DB_PASSWORD', "");
define('IPB_DB_NAME', "");
$ipb_db = mysql_connect(IPB_DB_HOST, IPB_DB_USERNAME, IPB_DB_PASSWORD) or trigger_error(mysql_error(), E_USER_ERROR);
mysql_select_db(IPB_DB_NAME, $ipb_db);
mysql_query("SET names windows-1251", $ipb_db);
$resultf = mysql_query("SELECT tid, title, description, state, posts, starter_id, last_poster_id, last_post, icon_id, starter_name, last_poster_name, views, topic_hasattach FROM ".IPB_DB_PREFIX."topics ORDER BY last_post DESC LIMIT ".IPB_POSTS_COUNT, $ipb_db) or die(mysql_error());
$nCount = mysql_num_rows($resultf);
$sResult = '<div id="rightcol_forum">
<!--<div id="rightcol_forum_header"><a href="'.IPB_FORUM_URL.'" target="_blank">Latest news</a></div>-->
<div id="rightcol_forum_body">';
if ($nCount) {
    $sResult .= '<ul>';
    while($res = mysql_fetch_assoc($resultf)) {
        $topicstrip = $res['title'];
        if (strlen($topicstrip) > IPB_TOPIC_MAXLENGTH) {
            $topicstrip = substr($topicstrip,0,IPB_TOPIC_MAXLENGTH);
            $topicstrip = $topicstrip."...";
        }

        $sResult .= '<li><a href="'.IPB_FORUM_URL.'index.php?showtopic='.$res['tid'].'&view=getlastpost">'.$topicstrip.'</a></li>';
    }
    $sResult .= '</ul>';
} else {
    $sResult .= 'Новых тем нет.';
}
$sResult .= '</div></div>';
mysql_free_result($resultf);
mysql_close($ipb_db);
echo $sResult;