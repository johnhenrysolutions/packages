<div>
    <h3 class="ui header">
        <?=$app['title']?>
    </h3>
        
    <div class="ui grid">
        <div class="row">
            <div class="four wide column">
           
                <div class="ui form">
                    <div class="grouped fields">

                        <?php $file_index = 0; foreach($app['files'] as $key => $value): ?>

                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input id="file-<?=$app_index?>-<?=$file_index?>" name="file" type="radio" onclick="loadFile(<?=$app_index?>, <?=$file_index?>)"/>
                                    <label for="file-<?=$app_index?>-<?=$file_index?>">
                                        <?=$value['description']?>
                                    </label>
                                </div>
                            </div>
                        <?php ++$file_index; endforeach; ?>
                        
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <div class="actions">
                    <button id="reset" class="ui button" onclick="doResetFile()" disabled>
                        Reset
                    </button>
                    
                    <button id="save" class="ui button blue" onclick="doSaveFile()" disabled>
                        Save
                    </button>
                </div>
                
                <div id="editor" class="editor"></div>
            </div>
            <div class="four wide column">
                <table>

                    <?php $command_index = 0; foreach($app['commands'] as $key => $value): ?>
                        <tr>
                            <td>
                                <?=$value['description']?>
                            </td>
                            <td>
                                <button id="commandbutton-<?=$app_index?>-<?=$command_index?>" class="ui circular icon blue button action-button" onclick="executeCommand(<?=$app_index?>, <?=$command_index?>)">
                                    <i class="play icon"></i>
                                </button>
                            </td>
                        </tr>
                    <?php ++$command_index; endforeach; ?>
                    
                </table>
            </div>
        </div>
    </div>
</div>
