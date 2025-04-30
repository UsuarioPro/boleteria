<style>
    html 
    {
        margin: 0;
    }
    .clearfix:after 
    {
        content: "";
        display: table;
        clear: both;
    }
    body 
    {
        margin: 0 auto; 
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 14px; 
        font-family: sans-serif;  
        padding-left: 1.5mm;
        padding-right: 1.5mm !important; 
    }
    .titulo
    {
        margin: -3px 0 2px 0;
        text-align: center;
        font-size: 11px;
    }
    header 
    {
        padding: 10px 0;
        margin-bottom: 10px;
    }
    .header_doc 
    {
        width: 100%;
        height: auto;
        float: center;
        text-align: center;
        font-size: 0.8em;
    }
    .header_doc img 
    {
        height: 70px;
    }
    .detalles 
    {
        font-style: normal;
        font-weight: bold;
        font-size: 8px;
        margin-bottom: 5px;
    }
    .invoice 
    {
        margin-top: 2px;
        border: 2px solid black;
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: center;
        font-weight: bold;
        width: 98%;
    }
    .invoice .doc_sm 
    {
        color: white;
        font-size: 1.3em;
        line-height: 1.3em;
        margin: 0 0 0 0;
    }    
    .invoice .doc_xl
    {
        color: white;
        font-size: 1.4em;
        line-height: 1.2em;
        margin: 0  0 0 0;
    }
    .invoice .franja 
    {
        background-color: rgb(0, 0, 0, 0.8);
        color: white;
        width: 100% !important;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .invoice .text 
    {
        font-size: 1.2em;
        color: black;
    }
    table 
    {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 10px;
    }

    table thead th
    {
        background-color: rgb(0, 0, 0, 0.8);
        color: white;
        font-weight: bold !important; 
        border: none;
        border-bottom: 0.5px solid black; 
        font-size: 10px;
    }
    table th, table td 
    {
        padding: 4px;
        background: transparent;
        border: none;
        border-bottom: 0.5px solid black;
        color: black;
        font-weight: normal;
        font-size: 9px;
    }
    table tfoot th 
    {
        border: none;
        font-size: 9px;
        white-space: nowrap; 
        font-weight: bold;
        text-align: center;
        padding-bottom: 0px;
    }

    /* table tfoot tr:last-child th 
    {
        color: black;
        font-size: 10px;
        border-top: 1px solid black; 
    } */

    table tfoot th td:first-child 
    {
        border: none;
    }
    table .numeral
    {
        width: 15px;
        text-align: center;
    }
    table .totales
    {
        width: 25px;
        text-align: center;
    }
    table .descripcion
    {
        width: 190px;
    }
    table .descripcion_venta
    {
        width: 30mm;
    }
    .text-center
    {
        text-align: center;
    }
    .text-right
    {
        text-align: right;
    }
    .font-bold
    {
        font-weight: bold;
    }
    .total_letras
    {
        border-bottom: 1px solid black;
        color: black;
        padding-bottom: 2px;
    }
    .descripcion_footer
    {
        border-bottom: 1px solid black;
        color: black;
        padding-bottom: 2px;
    }
    .descripcion_pagos
    {
        margin-top: 5px;
        border-bottom: 1px solid black;
        padding-bottom: 2px;
    }
    .descripcion_pagos ul
    {
        font-weight: normal;
        margin: 0;
        padding: 0px 0px 0px 15px;
    }
    .circulo
    {
        margin-top: 5px;
        border: 1px solid black;
        padding: 5px;
        border-radius: 5px;
        height: 85px;
        text-align: justify;
    }
    .qr_imagen
    {
        width: 85px !important; 
        height: 85px; 
        padding-top: 1px;
        float: left;
    }
    .qr_imagen img
    {
        width: 100%;
        height: 100%;
    }
    .rechazado
    {
        color: #fd7e14;
        font-weight: bold;
    }
</style>