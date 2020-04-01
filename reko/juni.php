
<!DOCTYPE html>
<html>

<head>
    <title>Innlevering2</title>
    <meta charset="utfl-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

</head>

<body class="boksmodell">
    <div id="boks">
        <header>
            <h1>Innlevering 2</h1>
        </header>
        <nav>
            <h3>Meny</h3>
            <ul>
                
                <li><a href="index.php">Hjem</a></li>
                <li><a>KLASSE</a></li>
                <li><a href="registrerklasse.php">Register klasse</a></li>
                <li><a href="visalleklasser.php">Vis alle klasser</a></li>
                <li><a href="endreklasse.php">Endre klasse</a></li>
                <li><a href="slettklasse.php">Slett klasse</a></li>
                <li><a>BILDE</a></li>
                <li><a href="registrerbilde.php">Registrer bilde</a></li>
                <li><a href="visallebilder.php">Vis alle bilder</a></li>
                <li><a href="endrebilde.php">Endre bilde</a></li>
                <li><a href="slettbilde.php">Slett bilde</a></li>
                <li><a>STUDENT</a></li>
                <li><a href="registrerstudent.php">Register student</a></li>
                <li><a href="visallestudenter.php">Vis alle studenter</a></li>
                <li><a href="endrestudent.php">Endre student</a></li>
                <li><a href="slettstudent.php">Slett student</a></li>
                <li><a>PROFIL</a></li>
                <li><a href="utlogging.php">Logg ut</a></li>
                <li><a href="innlogging.php">Logg inn</a></li>
                <li><a href="registrerbruker.php">Registrer bruker</a></li>
            </ul>
        </nav>
        <article>

            <h3>Registrer bilde </h3>

            <form action="" method="post" enctype="multipart/form-data" id="registrerBildeSkjema" name="registrerBildeSkjema">

                <input type="text" name="bildenr" id="bildenr" placeholder="Bildenr">

                <input type="date" name="opplastingsdato" id="opplastingsdato" placeholder="Opplastingsdato">

                <input type="text" name="beskrivelse" id="beskrivelse" placeholder="Beskrivelse">

                <input type="file" id="fil" name="fil" size="60">

                <input type="submit" name="Registrerbilde" id="registrerBildeKnapp" value="Registrer bilde">
                <input type="reset" namespace="Nullstill" id="nullstill" value="Nullstill">
            </form>



            <?php 


            if (isset($_POST["Registrerbilde"]))
            {

                $bildenr=$_POST["bildenr"];
                $opplastingsdato=$_POST["opplastingsdato"];
                $beskrivelse=$_POST["beskrivelse"];

            $filnavn=$_FILES["fil"]["name"];
            $filtype=$_FILES["fil"]["type"];
            $filstorrelse=$_FILES["fil"]["size"];
            $tmpnavn=$_FILES["fil"]["tmp_name"];
            $nyttnavn="bilder/".$filnavn;

                if (!$bildenr || !$opplastingsdato || !$filnavn || !$beskrivelse)
                {
                    print("Alle felt må fylles ut");
                }
            else if ($filtype!="image/gif" && $filtype!="image/jpeg" && $filtype!="image/png")
                {
                print("Det er kun tillatt å laste opp bilder");
                }
            else if ($filstorrelse>5000000) /*max=5MB, oppgis i byte*/ 
            {
                print("Størrelsen på bildet er for stort til å kunne lastes opp");
            }

                else
                    {
                        include("tilkobling.php");

                        $sqlHandling="SELECT * FROM BILDE WHERE bildenr='$bildenr';";
                        $sqlUtfall=mysqli_query($tilkobling,$sqlHandling) or die("ikke mulig å hente fra db-server");
                        $sqlRader=mysqli_num_rows($sqlUtfall);
                
                        if ($sqlRader!=0)
                        {
                        print ("Bildenr er registrert fra før");
                        }
                        else
                        {
                        move_uploaded_file($tmpnavn, $nyttnavn) or die ("Ikke mulig å laste opp fil");
                        $sqlHandling="INSERT INTO BILDE VALUES('$bildenr','$opplastingsdato','$filnavn','$beskrivelse');";
                        if(mysqli_query($tilkobling,$sqlHandling))
                        {
                            print ("Følgende bilde er nå registrert: <br />");
                                print ("<table border=1>");
                                print ("<tr><th align=left>bildenr</th> <th align=left>opplastingsdato</th> <th align=left>filnavn</th> <th align=left>beskrivelse</th> </tr>");
                                print ("<tr> <td> $bildenr </td> <td> $opplastingsdato </td> <td> $filnavn </td> <td> $beskrivelse </td> </tr>");
                                print ("</table>");
                        }
                        else 
                        {
                        print("Ikke mulig å registrere i databasen");
                        unlink($nyttnavn) or die("Ikke mulig å slette bilde på server");
                        }
                        }
                    }
            }

            ?>
        </article>
        <br class="clearfloat">
        <footer>
            <h5>Laget av Juni Nygaard</h5>
        </footer>
    </div>
</body>

</html>
