<p>
    <label>URL Banner:</label><br>
    <input type="url" name="url" value="<?=$url?>"/>
</p>

<p>
    <label>Ação do Clique:</label><br>
    <select name="acao" value="<?=$acao?>">
    <?php foreach ($acoesClique as $a) : ?>
        <option value="<?=$a['value']?>"  <?= $acao == $a['value'] ? 'selected="selected"' : ''?>><?=$a['label']?></option>
    <?php endforeach; ?>
    </select>
</p>

<p>
    <label>Status: </label><br>
    
    <select name="status" value="<?=$status?>">
    <?php foreach ($status as $s) : ?>
        <option value="<?=$s['value']?>" <?= $status == $s['value'] ? 'selected="selected"' : ''?>><?=$s['label']?></option>
    <?php endforeach; ?>
    </select>
</p>

<p>
    <label>Largura (px): </label><br>
    <input type="number" name="altura" value="<?=$altura?>"/>
</p>

<p>
    <label>Altura (px): </label><br>
    <input type="number" name="largura" value="<?=$largura?>"/>
</p>

<p>
    <label><input type="checkbox" name="responsivo" value"<?=$responsivo?>" <?= $responsivo ? 'checked="checked"' : '' ?>"/>Responsivo</label> 
</p>

<p>
    <label>Data de publicação: </label><br>
    <input type="date" name="data_publicacao" value="<?=$data_publicacao?>"/>
    <input type="time" name="hora_publicacao" value="<?=$hora_publicacao?>"/>
</p>

<p>
    <label>Data de expiração: </label><br>
    <input type="date" name="data_expiracao" value="<?=$data_expiracao?>"/>
    <input type="time" name="hora_expiracao" value="<?=$hora_expiracao?>"/>
</p>

<p>
    <label>Banner (.jpeg, .png, .gif)</label><br>
    
    <?php 
    
    $styleHidden = 'display: none; ';
    
    ?>
    <button type="button" id="wppa-add-midia" style="<?= !empty($imagem) ? 'display: none' : ''?>" class="button">
            Selecionar Banner
        </button>

        <button 
            type="button" 
            id="wppa-remove-midia" 
            class="button" 
            style="<?= empty($imagem) ? 'display: none' : ''?> border-color: darkred; color: darkred" 
            onclick="removerBanner()"> 
            Remover Banner
        </button>

    
    <input type="hidden" id="wppa-input-banner" name="imagem" value="<?=$imagem?>"/>
</p>

<div id="wppa-preview-banner" class="wppa-preview-banner">
    <?= is_numeric($imagem) ? wp_get_attachment_image($imagem, 'full', null, ['id'=>$imagem]): '';  ?>
</div>

<p>
    <strong>Posicionamento Automático</strong>
</p>
    
<p>
    <?php foreach($posicoes as $p): ?>
        <label>
            <span style="margin-right: 16px; display: inline-block; text-align: center">
                <img width="50" height="50" 
                    src="<?= wppa_get_plugin_url().'admin/images/'.$p['icon'].'.svg'?>">
                <br>
                <input type="radio" name="posicao" value="<?=$p['value']?>" <?= $posicao == $p['value'] ? 'checked="checked"' : '' ?>"/><?=$p['label']?>
            </span>
        </label>
    <?php endforeach; ?>
</p>


