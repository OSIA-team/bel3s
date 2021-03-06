<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:56
 */

///////////////////////////////////////////////////////////////////////////
// action detail
///////////////////////////////////////////////////////////////////////////
if($_GET['action'] == "detail"):


    if (isset($_GET['id'])){
        $id = $_GET['id'];

    }
    $jidloClass = new \database\jidlo();
    $jidlo = $jidloClass->getJidloById($id);
    // var_dump($jidlo);
    ?>
    <h2>Detail:</h2>
    <div id="main">

        <h3><?= $jidlo['nazev'] ?></h3>
        <fieldset>
            <input type="hidden" value="<?= $id ?>" name="id" disabled />
            <p><label>Název:</label><input type="text" class="text-long" name="nazev" value="<?= $jidlo['nazev'] ?>" disabled /></p>
            <p><label>Popis:</label><textarea rows="1" cols="1" name="popis" disabled><?= $jidlo['popis'] ?></textarea></p>
            <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience" value="<?= $jidlo['ingredience'] ?>" disabled />*Oddělit čárkou</p>
            <p><label>Kategorie:</label>
                <select name="kategorie" disabled>
                    <?php
                    $kategorie = new \database\kategorie();
                    $kategorie_item = $kategorie->getAllKategorie();
                    foreach ($kategorie_item as $key => $value) {
                        $selected = ( $value['url'] == $jidlo['kategorie'])?'selected':'';
                        $nazev = $value['nazev'];
                        $url = $value['url'];
                        echo "<option value=\"$url\" $selected >$nazev";
                    }
                    ?>
                </select>
            </p>
            <p><label>Gramáž:</label><input type="text" class="text-medium" name="gramaz" value="<?= $jidlo['gramaz'] ?>" disabled />*Připsat i g/ks/ml</p>

            <p><label>Cena:</label><input type="text" class="text-medium" name="cena" value="<?= $jidlo['cena'] ?>" disabled />Kč</p>

            <p><label>Sezóna</label>
                <select name="sezona" disabled>
                    <?php
                    $sezona     = new \database\sezona();
                    $sezony     = $sezona->getAllSezona();
                    $jsezona    = $sezona->getSezonaById($jidlo['id_sezona']);

                    foreach($sezony as $sezona):
                        $selected = ($sezona == $jsezona )?'selected':'';
                        ?>
                        <option value="<?= $sezona['id'] ?>" <?= $selected ?>><?= $sezona['nazev'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                <?php
                $pchecked = (@$jidlo['priloha'] == 1)?'checked':'';
                $pmchecked = (@$jidlo['priloha_modulo'] == 1)?'checked':'';
                ?>

                <label><input type="checkbox" name="priloha" value="1" class="jNiceCheckbox" style="display: block;" <?= $pchecked ?> disabled >Je příloha</label>
                <label><input type="checkbox" name="priloha_modulo" value="1" class="jNiceCheckbox" style="display: block;" <?= $pmchecked ?> disabled >Má přílohu</label>
            </p>
            <p>
                <?php
                $fotka = $jidloClass->getFotkaByJidloId($id);
                //var_dump($fotka);
                ?>
                <img src="../<?= $fotka['path'].$fotka['nazev'] ?>" height="150px" /> <br>
            </p>
        </fieldset>
    </div>
<?php
endif;
?>