ClassicEditor
    .create( document.querySelector( '#editorArticlePrevia' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

ClassicEditor
    .create( document.querySelector( '#editorArticleConteudo' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
ClassicEditor
    .create( document.querySelector( '#editorArticleResumo' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );