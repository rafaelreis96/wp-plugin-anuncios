 
<table class="form-table">
    <tbody>
        <tr valign="top">
            <th scope="row">
                <?=_e('URL Banner', 'wppa')?>
            </th>
            <td>
               <input type="url" name="url" value="<?=$url?>"/>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Ação do Clique', 'wppa')?>
            </th>
            <td>
               <select name="acao" value="<?=$acao?>">
                <?php foreach ($acoesClique as $a) : ?>
                    <option value="<?=$a['value']?>"  <?= $acao == $a['value'] ? 'selected="selected"' : ''?>><?=$a['label']?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Status', 'wppa')?>
            </th>
            <td>
               <select name="status" value="<?=$status?>">
                <?php foreach ($status as $s) : ?>
                    <option value="<?=$s['value']?>" <?= $status == $s['value'] ? 'selected="selected"' : ''?>><?=$s['label']?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Altura (px)', 'wppa')?>
            </th>
            <td>
               <input type="number" name="altura" value="<?=$altura?>"/>
            </td>
        </tr>
        
        
        <tr valign="top">
            <th scope="row">
                <?=_e('Largura (px):', 'wppa')?>
            </th>
            <td>
               <input type="number" name="largura" value="<?=$largura?>"/>
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row">
                <?=_e('Responsivo', 'wppa')?>
            </th>
            <td>
                <label><input type="checkbox" name="responsivo" value"<?=$responsivo?>" <?= $responsivo ? 'checked="checked"' : '' ?>"/>Sim</label> 
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Data de publicação', 'wppa')?>
            </th>
            <td>
               <input type="date" name="data_inicio" value="<?=$data_inicio?>"/>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Data de expiração', 'wppa')?>
            </th>
            <td>
               <input type="date" name="data_expiracao" value="<?=$data_expiracao?>"/>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Banner (.jpeg, .png, .gif)', 'wppa')?>
            </th>
            <td>
               <?php 
    
                $styleHidden = 'display: none; ';

                ?>
                
                <p style="margin-bottom: 10px">
                    <button type="button" id="wppa-add-midia" style="<?= !empty($imagem) ? 'display: none' : ''?>" class="button">
                        Selecionar Banner
                    </button>

                    <button 
                        type="button" 
                        id="wppa-remove-midia" 
                        class="button" 
                        style="<?= empty($imagem) ? 'display: none' : ''?> border-color: darkred; color: darkred" 
                        > 
                        Remover
                    </button>
                </p>

                <input type="hidden" id="wppa-input-banner" name="imagem" value="<?=$imagem?>"/>
            
                <div id="wppa-preview-banner" class="wppa-preview-banner">
                    <?= is_numeric($imagem) ? wp_get_attachment_image($imagem, 'full', null, ['id'=>$imagem]): '';  ?>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?=_e('Posicionamento Automático(posts, páginas)', 'wppa')?>
            </th>
            <td>
      
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
                
                 
            </td>
        </tr>
    </tbody>
</table>
    
 