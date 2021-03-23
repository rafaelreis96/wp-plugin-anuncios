var wppaBtnMidia = document.getElementById('wppa-add-midia');
var wppaBtnRemove = document.getElementById('wppa-remove-midia');
var wppaBanner   = document.getElementById('wppa-input-banner');
var wppaPreviewBanner = document.getElementById('wppa-preview-banner');

wppaBtnMidia.addEventListener('click', function(event) {
   if ( typeof wp !== 'undefined' && wp.media ) {
        var args = {
            title: "Selecione as Imagens para galeria",
            button:{ text: "Adicionar na Galeria" },
            multiple: true,
            type : 'image'
        };

        var frame = wp.media({
            title: "Selecione as wppaImagens para galeria",
            multiple: true,
            button:{ text: "Adicionar a Galeria" },
            library: {
                type: [ 'image' ]
            },
        });

        frame.on('select', function (){
            var state = frame.state();
            var selection = state.get('selection');

            if (!selection) {
                return;
            }

            selection.each(function(attachment) {
                //console.log(attachment.attributes);
                if(attachment.attributes.id) {
                    renderImageElement(attachment.attributes.id, attachment.attributes.url);
                }
            });

        });

        frame.on('close', function (){});
        frame.open();
    }
});

function renderImageElement(id, url) {
    wppaBanner.value = id;
    
    var img = document.createElement("img");
        img.setAttribute('id', id);
        img.setAttribute('src', url);
    
    wppaBtnRemove.style.display = 'block';
    wppaBtnMidia.style.display = 'none';
    
    wppaPreviewBanner.appendChild(img);
    
}     

function removerBanner() {
    const id = wppaBanner.value;
    wppaBtnRemove.style.display = 'none';
    wppaBtnMidia.style.display = 'block';
    
    if(document.getElementById(id)) {
        document.getElementById(id).style.opacity = 0;
        document.getElementById(id).style.background = 'red';
        document.getElementById(id).style.transition = '0.5s';

        setTimeout(function() {
            document.getElementById(id).remove();
            wppaBanner.value = '';
        }, 500);
    }
}