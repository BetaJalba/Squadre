<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="styles/styles.css">
        <meta charset="utf-8" />
    </head>
    <body>
        <header>
            <div class="logo">
            <a href="https://www.itisrossi.edu.it/">
                <img src="res/logo_rossi.png" alt="Logo">
            </a>
            </div>
            <nav>
                <a href="index.html">index</a>
                <a href="index.html">Modulo 2</a>
                <a href="https://example.com/contact">Modulo 3</a>
            </nav>
        </header>

        <main>
            <article>
                <form class="container" action="" method="get">

                    <h2>Informazioni</h2>

                    <label for="nome">Nome della squadra: *</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="num_part">Numero vinte: *</label>
                    <input type="number" id="num_win" name="num_win" min="0" value="0" required>

                    <label for="num_part">Numero pareggiate: *</label>
                    <input type="number" id="num_draw" name="num_draw" min="0" value="0" required>

                    <label for="num_part">Numero perso: *</label>
                    <input type="number" id="num_lose" name="num_lose" min="0" value="0" required>

                    <label for="categoria">Categoria squadre: *</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">--Scegli una categoria--</option>
                        <option value="U18">Under 18</option>
                        <option value="Adulto">Adulto</option>
                        <option value="Veterani">Veterani</option>
                    </select>

                    <label for="nuovo">Nuova squadra? *</label>
                    <div>
                        <input type="hidden" name="nuovo" value="off">
                        <input type="checkbox" id="nuovo" name="nuovo">
                    </div>

                    <div class="submit_div">
                        <input type="reset" id="cancella" value="Cancella Richiesta">
                        <input type="submit" id="submit" value="Invia Richiesta">
                    </div>
                </form>

                <?php
                foreach($_GET as $k => $v){
                    if (!isset($_SESSION[$k]) || !is_array($_SESSION[$k])) {
                        $_SESSION[$k] = [];
                    }
                    $_SESSION[$k][] = $v;
                }
                echo "Session variables are set.<br>";
                
                foreach($_SESSION as $k => $v){
                    print_r($v);
                    echo '<br>';
                }

                echo '<br>';

                //Ordina squadre in modo decrescente
                $win_sorted = $_SESSION['num_win'];
                $name_sorted = $_SESSION['nome'];
                array_multisort($win_sorted, SORT_DESC, SORT_REGULAR, $name_sorted);
                
                print_r($name_sorted);
                echo '<br>';
                print_r($win_sorted);
                echo '<br>';

                echo '<br>';

                //Controlla se tutte le squadre hanno avuto le stesse partite
                if (!isset($_SESSION['nome']))
                    return;

                $count = $_SESSION['num_win'][0] + $_SESSION['num_draw'][0] + $_SESSION['num_lose'][0];
                for($i = 0; $i < count($_SESSION['nome']); $i++){
                    if ($_SESSION['num_win'][$i] + $_SESSION['num_draw'][$i] + $_SESSION['num_lose'][$i] != $count){
                        echo 'Non tutte le squadre hanno giocato lo stesso numero di partite.<br>';
                        break;
                    }
                };

                echo '<br>';

                //Stampa squadre nuove
                echo 'Squadre nuove:<br>';
                for($i = 0; $i < count($_SESSION['nome']); $i++){
                    if ($_SESSION['nuovo'][$i] == 'on')
                        echo htmlspecialchars($_SESSION['nome'][$i]) . ' è una nuova squadra in categoria ' . htmlspecialchars($_SESSION['categoria'][$i]) . '<br>';
                };

                echo '<br>';
                ?>
            </article>
        </main>

        <footer class="footer">
            <div class="footer-container">
                <div class="footer-section">
                <h3>Contatti</h3>
                <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
                <p>Telefono: <a href="tel:+5837603986">+39 388 376 3829</a></p>
                </div>
                <div class="footer-section">
                <h3>Crediti</h3>
                <p>Sito fatto da Jabbabababa</p>
                <p>Footer fatto male!!1!</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 ITIS A. ROSSI. Tutti i diritti riservati. (non è vero)</p>
            </div>
        </footer>
    </body>
</html>