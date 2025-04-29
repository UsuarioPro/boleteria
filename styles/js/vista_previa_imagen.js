FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageValidateSize,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
    FilePondPluginFileEncode,
);
const option_FilePond = 
{
    allowMultiple: true,
    allowReorder: true,
    allowImageExifOrientation: true,
    credits : false,
    storeAsFile: true,
    instantUpload: true,
    server: 
    {
        load: 
        {
            headers: {
                'Cache-Control': 'no-store, no-cache, must-revalidate, max-age=0',
                'Cache-Control': 'post-check=0, pre-check=0, false',
                'Pragma': 'no-cache',
            },
        },
    },
}
const option_FilePondImage = 
{
    allowMultiple: false,
    fileSizeBase: '1024',
    imagePreviewHeight: '350px',
    maxFileSize: "3100KB",
    // stylePanelAspectRatio: '0.90',
    acceptedFileTypes: ['image/png','image/jpeg','image/jpg'],
}
FilePond.setOptions(option_FilePond);