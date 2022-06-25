<?php
    namespace Subdirectory;
    class subClass1
    {
        function printMessages($fileJSON): void
        {
            $jsonObject = json_decode(file_get_contents($fileJSON), false);

            foreach ($jsonObject->messages as $user)
            {
                $Login_Date = $user->user . ' ' . $user->date;
                echo "<div style='text-align: center'> <a href='http://212.193.51.81:81/'>$Login_Date </a></div>";
                echo "$user->message<br/><br/>";
            }
        }

        function printTableUsers($arrUsers) :void
        {
            foreach ($arrUsers as $user)
            {
                $login = "<td> $user->chatUser </td>";
                $password = "<td> $user->UserPassword </td>";
                echo "<tr> $login $password </tr>";
            }
        }
    }