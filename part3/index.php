<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        <input type="text" name="palindtext" placeholder="Enter here" />
        <input type="submit" name="submit">
    </form>
    <?php
        function palindrome($str)
        {
            $str=strtoupper($str);
            for ($i=0;$i<strlen($str);$i++)
                if ($str[$i]!=$str[strlen($str)-$i-1])
                    return 'Not Palindrome';
            return 'Palindrome!';
        }
        if(!empty($_GET['palindtext']) && isset($_GET['submit']))
        {
            echo palindrome($_GET['palindtext']);
        } 
    ?>
</body>
</html>
