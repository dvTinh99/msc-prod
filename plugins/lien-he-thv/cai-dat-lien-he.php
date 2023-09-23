<?php
	if ( ! empty( $_POST ) ) {
	echo '<div class="updated"><h3>' . esc_html__( 'Cập nhật các cài đặt thành công!') . '</3></div>';
}
?>
<div class="lien-he">
    <form method="post" action="">
        <div class="form-group">
            <h1>
                THÔNG TIN LIÊN HỆ
            </h1>
            <h3>Cài đặt </h3>
        </div>
        <table class="table-lien-he">
            <tr>
                <td>
                    <div class="form-group">
                        <label class="label">Messenger</label>
                        <input type="text" name="mess-ring" style="width: 450px" value='<?php echo $messenger; ?>' class="form-control" placeholder="Nhập link messenger">
                        <span class="form-text text-muted">    - VD: https://www.facebook.com/</span>
                    </div>
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Icon
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_ic_mess" value='<?php echo $color_bg_ic_mess; ?>' data-coloris >
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Overlay
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_Overlay_mess" value='<?php echo $color_bg_Overlay_mess; ?>' data-coloris>
                </td>
                <td class="disable-enabled">
                    <?php if ($disable_enabled_mess == 'none'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='none' checked='checked'>
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='block' >
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_mess == 'block'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='none' >
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_mess == ''): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='none' >
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_mess" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="label">Zalo</label>
                        <input type="text" name="zalo-ring" style="width: 450px" value='<?php echo $zalo; ?>' class="form-control" placeholder="Nhập số zalo">
                        <span class="form-text text-muted">    - VD: 0359229731</span>
                    </div>
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Icon
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_ic_zalo" value='<?php echo $color_bg_ic_zalo; ?>' data-coloris>
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Overlay
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_Overlay_zalo" value='<?php echo $color_bg_Overlay_zalo; ?>' data-coloris>
                </td>
                <td class="disable-enabled">
                    <?php if ($disable_enabled_zalo == 'none'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='none' checked='checked'>
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='block' >
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_zalo == 'block'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='none' >
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_zalo == ''): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='none' >
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_zalo" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="label">Hotline</label>
                        <input type="text" name="hotline-ring" style="width: 450px" value='<?php echo $hotline; ?>' class="form-control" placeholder="Nhập số hotline">
                        <span class="form-text text-muted">    - VD: 035.9229.731</span>
                    </div>
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Icon
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_ic_hotline" value='<?php echo $color_bg_ic_hotline; ?>' data-coloris>
                </td>
                <td class="table-color">
                    <p class="title-color">
                        Background Overlay
                    </p>
                    <input type="text" class="coloris" class="form-control" name="color_bg_Overlay_hotline" value='<?php echo $color_bg_Overlay_hotline; ?>' data-coloris>
                </td>
                <td class="disable-enabled">
                    <?php if ($disable_enabled_hotline == 'none'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='none' checked='checked'>
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='block' >
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_hotline == 'block'): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='none'>
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php elseif ($disable_enabled_hotline == ''): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='none'>
                            <label class="form-check-label" >
                            Disable
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="disable_enabled_hotline" value='block' checked='checked'>
                            <label class="form-check-label" >
                            Enabled
                            </label>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <div class="left_right">
            <p class="title-color">
                Alignment
            </p>
            <?php if ($radio_left_right == 'left'): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='left' checked='checked'>
                <label class="form-check-label" >
                    Left
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='right' >
                <label class="form-check-label" >
                    Right
                </label>
            </div>
            <?php elseif ($radio_left_right == 'right'): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='left' >
                <label class="form-check-label" >
                    Left
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='right' checked='checked'>
                <label class="form-check-label" >
                    Right
                </label>
            </div>
            <?php elseif ($radio_left_right == ''): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='left' checked='checked'>
                <label class="form-check-label" >
                    Left
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio_left_right" value='right' >
                <label class="form-check-label" >
                    Right
                </label>
            </div>
            <?php endif; ?>
            <p class="title-color" style="margin-left: 40px;">
                Bottom
            </p>
            <div class="form-check">
                <input type="number" name="bottom_mar" style="width: 100px" value='<?php if($bottom_mar != ''){echo $bottom_mar;}else{echo '0';} ?>' placeholder="10" class="form-control">%
            </div>
        </div>
        <div class="form_indent">
            <p class="title-color">
                Indent phone
            </p>
            <div class="form-check">
                <input type="number" name="text_indent" style="width: 100px" value='<?php if($text_indent != ''){echo $text_indent;}else{echo '60';} ?>' placeholder="15" class="form-control">px
            </div>
        </div>
        <div class="button_save">
            <input type="submit" name="save" class="btn btn-primary" value="Lưu thay đổi">
        </div>
    </form>
</div>
<style>
	
td.table-color {
    display: flex;
    align-content: stretch;
    margin-left: 20px;
    float: left;
    align-items: center;
    flex-direction: column;
}

p.title-color {
    font-size: 16px;
    color: #0400ff;
    font-family: cursive;
}

.clr-field button {
    border-radius: 2px !important;
    right: 6px !important;
    width: 161px !important;
    height: 25px !important;
}
	
input.coloris {
    border: 1px solid #eeee !important;
    padding: 3px !important;
    border-radius: 5px !important;
}
	
.lien-he {
    margin: 35px;
}
.form-group {
    margin-bottom: 1rem;
}
	
.form-group h1 {
    color: red;
}
	
.form-group h3 {
    color: #0400ff;
}
	
.form-group label {
    display: inline-block;
    margin-bottom: 0.5rem;
	font-size: 18px;
    color: #000000;
}

.form-group .form-control {
    transition: none;
}

.form-group .form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.form-group .text-muted {
    color: #6c757d!important;
}

.form-group .form-text {
    display: block;
    margin-top: 0.25rem;
}

.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background-color: #33af28;
    border-color: #33af28;
}

.updated h3 {
    color: #404ef3;
}
td.disable-enabled .form-check, .top_margin .form-check, .bottom_margin .form-check {
    margin-right: 10px;
}
td.disable-enabled, .top_margin, .bottom_margin, .left_right {
    display: flex;
    line-height: 7;
    padding: 10px 25px;
}
.left_right,.form_indent {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0;
}
.left_right .form-check, .form_indent input{
    margin: 0 10px;
}
.form_indent {
    margin-bottom: 10px;
}
.form_indent input {
    margin-right: 0;
}
</style>

<style>
	.clr-picker{display:none;flex-wrap:wrap;position:absolute;width:200px;z-index:1000;border-radius:10px;background-color:#fff;justify-content:space-between;box-shadow:0 0 5px rgba(0,0,0,.05),0 5px 20px rgba(0,0,0,.1);-moz-user-select:none;-webkit-user-select:none;user-select:none}.clr-picker.clr-open{display:flex}.clr-picker[data-alpha=false] .clr-alpha{display:none}.clr-gradient{position:relative;width:100%;height:100px;margin-bottom:15px;border-radius:3px 3px 0 0;background-image:linear-gradient(rgba(0,0,0,0),#000),linear-gradient(90deg,#fff,currentColor);cursor:pointer}.clr-marker{position:absolute;width:12px;height:12px;margin:-6px 0 0 -6px;border:1px solid #fff;border-radius:50%;background-color:currentColor;cursor:pointer}.clr-picker input[type=range]::-webkit-slider-runnable-track{width:100%;height:8px}.clr-picker input[type=range]::-webkit-slider-thumb{width:8px;height:8px;-webkit-appearance:none}.clr-picker input[type=range]::-moz-range-track{width:100%;height:8px;border:0}.clr-picker input[type=range]::-moz-range-thumb{width:8px;height:8px;border:0}.clr-hue{background-image:linear-gradient(to right,red 0,#ff0 16.66%,#0f0 33.33%,#0ff 50%,#00f 66.66%,#f0f 83.33%,red 100%)}.clr-alpha,.clr-hue{position:relative;width:calc(100% - 40px);height:8px;margin:5px 20px;border-radius:4px}.clr-alpha span{display:block;height:100%;width:100%;border-radius:inherit;background-image:linear-gradient(90deg,rgba(0,0,0,0),currentColor)}.clr-alpha input,.clr-hue input{position:absolute;width:calc(100% + 16px);height:16px;left:-8px;top:-4px;margin:0;background-color:transparent;opacity:0;cursor:pointer;appearance:none;-webkit-appearance:none}.clr-alpha div,.clr-hue div{position:absolute;width:16px;height:16px;left:0;top:50%;margin-left:-8px;transform:translateY(-50%);border:2px solid #fff;border-radius:50%;background-color:currentColor;box-shadow:0 0 1px #888;pointer-events:none}.clr-alpha div:before{content:'';position:absolute;height:100%;width:100%;left:0;top:0;border-radius:50%;background-color:currentColor}.clr-format{display:none;order:1;width:calc(100% - 40px);margin:0 20px 20px}.clr-segmented{display:flex;position:relative;width:100%;margin:0;padding:0;border:1px solid #ddd;border-radius:15px;box-sizing:border-box;color:#999;font-size:12px}.clr-segmented input,.clr-segmented legend{position:absolute;width:100%;height:100%;margin:0;padding:0;border:0;left:0;top:0;opacity:0;pointer-events:none}.clr-segmented label{flex-grow:1;padding:4px 0;text-align:center;cursor:pointer}.clr-segmented label:first-of-type{border-radius:10px 0 0 10px}.clr-segmented label:last-of-type{border-radius:0 10px 10px 0}.clr-segmented input:checked+label{color:#fff;background-color:#666}.clr-swatches{order:2;width:calc(100% - 32px);margin:0 16px}.clr-swatches div{display:flex;flex-wrap:wrap;padding-bottom:12px;justify-content:center}.clr-swatches button{position:relative;width:20px;height:20px;margin:0 4px 6px 4px;border:0;border-radius:50%;color:inherit;text-indent:-1000px;white-space:nowrap;overflow:hidden;cursor:pointer}.clr-swatches button:after{content:'';display:block;position:absolute;width:100%;height:100%;left:0;top:0;border-radius:inherit;background-color:currentColor;box-shadow:inset 0 0 0 1px rgba(0,0,0,.1)}input.clr-color{order:1;width:calc(100% - 80px);height:32px;margin:15px 20px 20px 0;padding:0 10px;border:1px solid #ddd;border-radius:16px;color:#444;background-color:#fff;font-family:sans-serif;font-size:14px;text-align:center;box-shadow:none}input.clr-color:focus{outline:0;border:1px solid #1e90ff}.clr-clear{display:none;order:2;height:24px;margin:0 20px 20px auto;padding:0 20px;border:0;border-radius:12px;color:#fff;background-color:#666;font-family:inherit;font-size:12px;font-weight:400;cursor:pointer}.clr-preview{position:relative;width:32px;height:32px;margin:15px 0 20px 20px;border:0;border-radius:50%;overflow:hidden;cursor:pointer}.clr-preview:after,.clr-preview:before{content:'';position:absolute;height:100%;width:100%;left:0;top:0;border:1px solid #fff;border-radius:50%}.clr-preview:after{border:0;background-color:currentColor;box-shadow:inset 0 0 0 1px rgba(0,0,0,.1)}.clr-alpha div,.clr-color,.clr-hue div,.clr-marker{box-sizing:border-box}.clr-field{display:inline-block;position:relative;color:transparent}.clr-field button{position:absolute;width:30px;height:100%;right:0;top:50%;transform:translateY(-50%);border:0;color:inherit;text-indent:-1000px;white-space:nowrap;overflow:hidden;pointer-events:none}.clr-field button:after{content:'';display:block;position:absolute;width:100%;height:100%;left:0;top:0;border-radius:inherit;background-color:currentColor;box-shadow:inset 0 0 1px rgba(0,0,0,.5)}.clr-alpha,.clr-alpha div,.clr-field button,.clr-preview:before,.clr-swatches button{background-image:repeating-linear-gradient(45deg,#aaa 25%,transparent 25%,transparent 75%,#aaa 75%,#aaa),repeating-linear-gradient(45deg,#aaa 25%,#fff 25%,#fff 75%,#aaa 75%,#aaa);background-position:0 0,4px 4px;background-size:8px 8px}.clr-marker:focus{outline:0}.clr-keyboard-nav .clr-alpha input:focus+div,.clr-keyboard-nav .clr-hue input:focus+div,.clr-keyboard-nav .clr-marker:focus,.clr-keyboard-nav .clr-segmented input:focus+label{outline:0;box-shadow:0 0 0 2px #1e90ff,0 0 2px 2px #fff}.clr-dark{background-color:#444}.clr-dark .clr-segmented{border-color:#777}.clr-dark .clr-swatches button:after{box-shadow:inset 0 0 0 1px rgba(255,255,255,.3)}.clr-dark input.clr-color{color:#fff;border-color:#777;background-color:#555}.clr-dark input.clr-color:focus{border-color:#1e90ff}.clr-dark .clr-preview:after{box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}.clr-picker.clr-polaroid{border-radius:6px;box-shadow:0 0 5px rgba(0,0,0,.1),0 5px 30px rgba(0,0,0,.2)}.clr-picker.clr-polaroid:before{content:'';display:block;position:absolute;width:16px;height:10px;left:20px;top:-10px;border:solid transparent;border-width:0 8px 10px 8px;border-bottom-color:currentColor;box-sizing:border-box;color:#fff;filter:drop-shadow(0 -4px 3px rgba(0,0,0,.1));pointer-events:none}.clr-picker.clr-polaroid.clr-dark:before{color:#444}.clr-picker.clr-polaroid.clr-left:before{left:auto;right:20px}.clr-picker.clr-polaroid.clr-top:before{top:auto;bottom:-10px;transform:rotateZ(180deg)}.clr-polaroid .clr-gradient{width:calc(100% - 20px);height:120px;margin:10px;border-radius:3px}.clr-polaroid .clr-alpha,.clr-polaroid .clr-hue{width:calc(100% - 30px);height:10px;margin:6px 15px;border-radius:5px}.clr-polaroid .clr-alpha div,.clr-polaroid .clr-hue div{box-shadow:0 0 5px rgba(0,0,0,.2)}.clr-polaroid .clr-format{width:calc(100% - 20px);margin:0 10px 15px}.clr-polaroid .clr-swatches{width:calc(100% - 12px);margin:0 6px}.clr-polaroid .clr-swatches div{padding-bottom:10px}.clr-polaroid .clr-swatches button{width:22px;height:22px}.clr-polaroid input.clr-color{width:calc(100% - 60px);margin:10px 10px 15px 0}.clr-polaroid .clr-clear{margin:0 10px 15px auto}.clr-polaroid .clr-preview{margin:10px 0 15px 10px}.clr-picker.clr-large{width:275px}.clr-large .clr-gradient{height:150px}.clr-large .clr-swatches button{width:22px;height:22px}
</style>
<script type = "text/javascript" >
	!function(d,p,s){var h,f,v,c,u,y,i,b,l,g,m,w,k,x,a=p.createElement("canvas").getContext("2d"),E={r:0,g:0,b:0,h:0,s:0,v:0,a:1},L={el:"[data-coloris]",parent:null,theme:"default",themeMode:"light",wrap:!0,margin:2,format:"hex",formatToggle:!1,swatches:[],alpha:!0,clearButton:{show:!1,label:"Clear"},a11y:{open:"Open color picker",close:"Close color picker",marker:"Saturation: {s}. Brightness: {v}.",hueSlider:"Hue slider",alphaSlider:"Opacity slider",input:"Color value field",format:"Color format",swatch:"Color swatch",instruction:"Saturation and brightness selector. Use up, down, left and right arrow keys to select."}};function o(e){if("object"==typeof e)for(var t in e)switch(t){case"el":S(e.el),!1!==e.wrap&&T(e.el);break;case"parent":L.parent=p.querySelector(e.parent),L.parent&&L.parent.appendChild(h);break;case"themeMode":L.themeMode=e.themeMode,"auto"===e.themeMode&&d.matchMedia&&d.matchMedia("(prefers-color-scheme: dark)").matches&&(L.themeMode="dark");case"theme":e.theme&&(L.theme=e.theme),h.className="clr-picker clr-"+L.theme+" clr-"+L.themeMode;break;case"margin":e.margin*=1,L.margin=(isNaN(e.margin)?L:e).margin;break;case"wrap":e.el&&e.wrap&&T(e.el);break;case"format":L.format=e.format;break;case"formatToggle":N("clr-format").style.display=e.formatToggle?"block":"none",e.formatToggle&&(L.format="auto");break;case"swatches":Array.isArray(e.swatches)&&function(){var a=[];e.swatches.forEach(function(e,t){a.push('<button id="clr-swatch-'+t+'" aria-labelledby="clr-swatch-label clr-swatch-'+t+'" style="color: '+e+';">'+e+"</button>")}),a.length&&(N("clr-swatches").innerHTML="<div>"+a.join("")+"</div>")}();break;case"alpha":L.alpha=!!e.alpha,h.setAttribute("data-alpha",L.alpha);break;case"clearButton":var a="none";e.clearButton.show&&(a="block"),e.clearButton.label&&(i.innerHTML=e.clearButton.label),i.style.display=a;break;case"a11y":var l,r=e.a11y,o=!1;if("object"==typeof r)for(var n in r)r[n]&&L.a11y[n]&&(L.a11y[n]=r[n],o=!0);o&&(l=N("clr-open-label"),a=N("clr-swatch-label"),l.innerHTML=L.a11y.open,a.innerHTML=L.a11y.swatch,u.setAttribute("aria-label",L.a11y.close),b.setAttribute("aria-label",L.a11y.hueSlider),g.setAttribute("aria-label",L.a11y.alphaSlider),y.setAttribute("aria-label",L.a11y.input),f.setAttribute("aria-label",L.a11y.instruction))}}function S(e){D(p,"click",e,function(e){var t=L.parent,a=e.target.getBoundingClientRect(),l=d.scrollY,r={left:!1,top:!1},o={x:0,y:0},n=a.x,i=l+a.y+a.height+L.margin;w=e.target,x=w.value,k=function(e){e=e.substring(0,3).toLowerCase();return"rgb"!==e&&"hsl"!==e?"hex":e}(x),h.classList.add("clr-open");var c,s=h.offsetWidth,u=h.offsetHeight;t?(c=d.getComputedStyle(t),e=parseFloat(c.marginTop),c=parseFloat(c.borderTopWidth),(o=t.getBoundingClientRect()).y+=c+l,n-=o.x,i-=o.y,n+s>t.clientWidth&&(n+=a.width-s,r.left=!0),i+u>t.clientHeight-e&&(i-=a.height+u+2*L.margin,r.top=!0),i+=t.scrollTop):(n+s>p.documentElement.clientWidth&&(n+=a.width-s,r.left=!0),i+u-l>p.documentElement.clientHeight&&(i=l+a.y-u-L.margin,r.top=!0)),h.classList.toggle("clr-left",r.left),h.classList.toggle("clr-top",r.top),h.style.left=n+"px",h.style.top=i+"px",v={width:f.offsetWidth,height:f.offsetHeight,x:h.offsetLeft+f.offsetLeft+o.x,y:h.offsetTop+f.offsetTop+o.y},A(x),y.focus({preventScroll:!0})}),D(p,"input",e,function(e){var t=e.target.parentNode;t.classList.contains("clr-field")&&(t.style.color=e.target.value)})}function T(e){p.querySelectorAll(e).forEach(function(e){var t,a=e.parentNode;a.classList.contains("clr-field")||((t=p.createElement("div")).innerHTML='<button aria-labelledby="clr-open-label"></button>',a.insertBefore(t,e),t.setAttribute("class","clr-field"),t.style.color=e.value,t.appendChild(e))})}function n(e){w&&(e&&x!==w.value&&(w.value=x,w.dispatchEvent(new Event("input",{bubbles:!0}))),x!==w.value&&w.dispatchEvent(new Event("change",{bubbles:!0})),h.classList.remove("clr-open"),w.focus({preventScroll:!0}),w=null)}function A(e){var t=function(e){a.fillStyle="#000",a.fillStyle=e,e=(e=/^((rgba)|rgb)[\D]+([\d.]+)[\D]+([\d.]+)[\D]+([\d.]+)[\D]*?([\d.]+|$)/i.exec(a.fillStyle))?{r:+e[3],g:+e[4],b:+e[5],a:+e[6]}:(e=a.fillStyle.replace("#","").match(/.{2}/g).map(function(e){return parseInt(e,16)}),{r:e[0],g:e[1],b:e[2],a:1});return e}(e),e=function(e){var t=e.r/255,a=e.g/255,l=e.b/255,r=s.max(t,a,l),o=s.min(t,a,l),n=r-o,i=r,c=0,o=0;n&&(r===t&&(c=(a-l)/n),r===a&&(c=2+(l-t)/n),r===l&&(c=4+(t-a)/n),r&&(o=n/r));return{h:(c=s.floor(60*c))<0?c+360:c,s:s.round(100*o),v:s.round(100*i),a:e.a}}(t);C(e.s,e.v),H(t,e),b.value=e.h,h.style.color="hsl("+e.h+", 100%, 50%)",l.style.left=e.h/360*100+"%",c.style.left=v.width*e.s/100+"px",c.style.top=v.height-v.height*e.v/100+"px",g.value=100*e.a,m.style.left=100*e.a+"%"}function r(e){w&&(w.value=e||y.value,w.dispatchEvent(new Event("input",{bubbles:!0})))}function M(e,t){e={h:+b.value,s:e/v.width*100,v:100-t/v.height*100,a:g.value/100},t=function(e){var t=e.s/100,a=e.v/100,l=t*a,r=e.h/60,o=l*(1-s.abs(r%2-1)),n=a-l;l+=n,o+=n;t=s.floor(r)%6,a=[l,o,n,n,o,l][t],r=[o,l,l,o,n,n][t],t=[n,n,o,l,l,o][t];return{r:s.round(255*a),g:s.round(255*r),b:s.round(255*t),a:e.a}}(e);C(e.s,e.v),H(t,e),r()}function C(e,t){var a=L.a11y.marker;e=+e.toFixed(1),t=+t.toFixed(1),a=(a=a.replace("{s}",e)).replace("{v}",t),c.setAttribute("aria-label",a)}function t(e){var t={pageX:((a=e).changedTouches?a.changedTouches[0]:a).pageX,pageY:(a.changedTouches?a.changedTouches[0]:a).pageY},a=t.pageX-v.x,t=t.pageY-v.y;L.parent&&(t+=L.parent.scrollTop),a=a<0?0:a>v.width?v.width:a,t=t<0?0:t>v.height?v.height:t,c.style.left=a+"px",c.style.top=t+"px",M(a,t),e.preventDefault(),e.stopPropagation()}function H(e,t){void 0===t&&(t={});var a,l,r=L.format;for(a in e=void 0===e?{}:e)E[a]=e[a];for(l in t)E[l]=t[l];var o,n=function(e){var t=e.r.toString(16),a=e.g.toString(16),l=e.b.toString(16),r="";e.r<16&&(t="0"+t);e.g<16&&(a="0"+a);e.b<16&&(l="0"+l);L.alpha&&e.a<1&&(e=255*e.a|0,r=e.toString(16),e<16&&(r="0"+r));return"#"+t+a+l+r}(E),i=n.substring(0,7);switch(c.style.color=i,m.parentNode.style.color=i,m.style.color=n,u.style.color=n,f.style.display="none",f.offsetHeight,f.style.display="",m.nextElementSibling.style.display="none",m.nextElementSibling.offsetHeight,m.nextElementSibling.style.display="","mixed"===r?r=1===E.a?"hex":"rgb":"auto"===r&&(r=k),r){case"hex":y.value=n;break;case"rgb":y.value=(o=E,L.alpha&&1!==o.a?"rgba("+o.r+", "+o.g+", "+o.b+", "+o.a+")":"rgb("+o.r+", "+o.g+", "+o.b+")");break;case"hsl":y.value=(o=function(e){var t,a=e.v/100,l=a*(1-e.s/100/2);0<l&&l<1&&(t=s.round((a-l)/s.min(l,1-l)*100));return{h:e.h,s:t||0,l:s.round(100*l),a:e.a}}(E),L.alpha&&1!==o.a?"hsla("+o.h+", "+o.s+"%, "+o.l+"%, "+o.a+")":"hsl("+o.h+", "+o.s+"%, "+o.l+"%)")}p.querySelector('.clr-format [value="'+r+'"]').checked=!0}function e(){var e=+b.value,t=+c.style.left.replace("px",""),a=+c.style.top.replace("px","");h.style.color="hsl("+e+", 100%, 50%)",l.style.left=e/360*100+"%",M(t,a)}function B(){var e=g.value/100;m.style.left=100*e+"%",H({a:e}),r()}function N(e){return p.getElementById(e)}function D(e,t,a,l){var r=Element.prototype.matches||Element.prototype.msMatchesSelector;"string"==typeof a?e.addEventListener(t,function(e){r.call(e.target,a)&&l.call(e.target,e)}):(l=a,e.addEventListener(t,l))}function O(e,t){t=void 0!==t?t:[],"loading"!==p.readyState?e.apply(void 0,t):p.addEventListener("DOMContentLoaded",function(){e.apply(void 0,t)})}void 0!==NodeList&&NodeList.prototype&&!NodeList.prototype.forEach&&(NodeList.prototype.forEach=Array.prototype.forEach),d.Coloris=function(){var r={set:o,wrap:T,close:n};function e(e){O(function(){e&&("string"==typeof e?S:o)(e)})}for(var t in r)!function(l){e[l]=function(){for(var e=arguments.length,t=new Array(e),a=0;a<e;a++)t[a]=arguments[a];O(r[l],t)}}(t);return e}(),O(function(){(h=p.createElement("div")).setAttribute("id","clr-picker"),h.className="clr-picker",h.innerHTML='<input id="clr-color-value" class="clr-color" type="text" value="" aria-label="'+L.a11y.input+'"><div id="clr-color-area" class="clr-gradient" role="application" aria-label="'+L.a11y.instruction+'"><div id="clr-color-marker" class="clr-marker" tabindex="0"></div></div><div class="clr-hue"><input id="clr-hue-slider" type="range" min="0" max="360" step="1" aria-label="'+L.a11y.hueSlider+'"><div id="clr-hue-marker"></div></div><div class="clr-alpha"><input id="clr-alpha-slider" type="range" min="0" max="100" step="1" aria-label="'+L.a11y.alphaSlider+'"><div id="clr-alpha-marker"></div><span></span></div><div id="clr-format" class="clr-format"><fieldset class="clr-segmented"><legend>'+L.a11y.format+'</legend><input id="clr-f1" type="radio" name="clr-format" value="hex"><label for="clr-f1">Hex</label><input id="clr-f2" type="radio" name="clr-format" value="rgb"><label for="clr-f2">RGB</label><input id="clr-f3" type="radio" name="clr-format" value="hsl"><label for="clr-f3">HSL</label><span></span></fieldset></div><div id="clr-swatches" class="clr-swatches"></div><button id="clr-clear" class="clr-clear">'+L.clearButton.label+'</button><button id="clr-color-preview" class="clr-preview" aria-label="'+L.a11y.close+'"></button><span id="clr-open-label" hidden>'+L.a11y.open+'</span><span id="clr-swatch-label" hidden>'+L.a11y.swatch+"</span>",p.body.appendChild(h),f=N("clr-color-area"),c=N("clr-color-marker"),i=N("clr-clear"),u=N("clr-color-preview"),y=N("clr-color-value"),b=N("clr-hue-slider"),l=N("clr-hue-marker"),g=N("clr-alpha-slider"),m=N("clr-alpha-marker"),S(L.el),T(L.el),D(h,"mousedown",function(e){h.classList.remove("clr-keyboard-nav"),e.stopPropagation()}),D(f,"mousedown",function(e){D(p,"mousemove",t)}),D(f,"touchstart",function(e){p.addEventListener("touchmove",t,{passive:!1})}),D(c,"mousedown",function(e){D(p,"mousemove",t)}),D(c,"touchstart",function(e){p.addEventListener("touchmove",t,{passive:!1})}),D(y,"change",function(e){A(y.value),r()}),D(i,"click",function(e){r(""),n()}),D(u,"click",function(e){r(),n()}),D(p,"click",".clr-format input",function(e){k=e.target.value,H(),r()}),D(h,"click",".clr-swatches button",function(e){A(e.target.textContent),r()}),D(p,"mouseup",function(e){p.removeEventListener("mousemove",t)}),D(p,"touchend",function(e){p.removeEventListener("touchmove",t)}),D(p,"mousedown",function(e){h.classList.remove("clr-keyboard-nav"),n()}),D(p,"keydown",function(e){"Escape"===e.key?n(!0):"Tab"===e.key&&h.classList.add("clr-keyboard-nav")}),D(p,"click",".clr-field button",function(e){e.target.nextElementSibling.dispatchEvent(new Event("click",{bubbles:!0}))}),D(c,"keydown",function(e){var t={ArrowUp:[0,-1],ArrowDown:[0,1],ArrowLeft:[-1,0],ArrowRight:[1,0]};-1!==Object.keys(t).indexOf(e.key)&&(!function(e,t){e=+c.style.left.replace("px","")+e,t=+c.style.top.replace("px","")+t,c.style.left=e+"px",c.style.top=t+"px",M(e,t)}.apply(void 0,t[e.key]),e.preventDefault())}),D(f,"click",t),D(b,"input",e),D(g,"input",B)})}(window,document,Math);
</script>