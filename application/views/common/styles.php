<style>
    html, body {
        min-height: 100%;
    }
    body, div, form, input, select, textarea, p {
        padding: 0;
        margin: 0;
        outline: none;
        font-family: Roboto, Arial, sans-serif;
        font-size: 14px;
        color: #666;
        line-height: 22px;
    }
    h1 {
        position: absolute;
        margin: 0;
        font-size: 32px;
        color: #fff;
        z-index: 2;
    }
    h2 {
        font-weight: 400;
    }
    .testbox {
        display: flex;
        justify-content: center;
        align-items: center;
        height: inherit;
        padding: 20px;
    }
    form {
        width: 100%;
        padding: 20px;
        border-radius: 6px;
        background: #fff;
        box-shadow: 0 0 20px 0 #095484;
    }
    .banner {
        position: relative;
        height: 210px;
        background-image: url("/images/MK-Map.png");
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .banner::after {
        content: "";
        background-color: rgba(0, 0, 0, 0.12);
        position: absolute;
        width: 100%;
        height: 100%;
    }
    input, select, textarea {
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    input {
        width: calc(100% - 10px);
        padding: 5px;
    }
    select {
        width: 100%;
        padding: 7px;
        background: transparent;
        background: url("/images/selectbox-arrow.png") right center no-repeat;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    textarea {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 100%;
        padding: 7px;
    }
    .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder, a {
        color: #095484;
    }
    .item input:hover, .item select:hover, .item textarea:hover {
        border: 1px solid transparent;
        box-shadow: 0 0 6px 0 #095484;
        color: #095484;
    }
    .item {
        position: relative;
        margin: 10px 0;
    }
    input[type="date"]::-webkit-inner-spin-button {
        display: none;
    }
    .item i, input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        font-size: 20px;
        color: #a9a9a9;
    }
    .item i {
        right: 2%;
        top: 30px;
        z-index: 1;
    }
    .textscroll {
        max-height: 120px;
        overflow-x: hidden;
        overflow-y: auto;
    }
    [type="date"]::-webkit-calendar-picker-indicator {
        right: 1%;
        z-index: 2;
        opacity: 0;
        cursor: pointer;
    }
    input[type=checkbox]  {
        display: none;
    }
    label.check {
        position: relative;
        display: inline-block;
        margin: 5px 20px 10px 0;
        cursor: pointer;
    }
    .question span {
        margin-left: 30px;
    }
    span.mandatory {
        color: red;
        margin-left: 0;
        font-weight: 700;
        display: inline;
    }
    span.required {
        margin-left: 0;
        color: red;
    }
    label.check:before {
        content: "";
        position: absolute;
        top: 2px;
        left: 0;
        width: 16px;
        height: 16px;
        border-radius: 2px;
        border: 1px solid #095484;
    }
    input[type=checkbox]:checked + .check:before {
        background: #095484;
    }
    label.check:after {
        content: "";
        position: absolute;
        top: 6px;
        left: 4px;
        width: 8px;
        height: 4px;
        border: 3px solid #fff;
        border-top: none;
        border-right: none;
        transform: rotate(-45deg);
        opacity: 0;
    }
    input[type=checkbox]:checked + label:after {
        opacity: 1;
    }
    .btn-block {
        margin-top: 10px;
        text-align: center;
    }
    button {
        width: 150px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background: #095484;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
    }
    button:hover {
        background: #0666a3;
    }
    @media (min-width: 568px) {
        .name-item, .city-item {
            display: inline;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .name-item input, .city-item input {
            width: calc(50% - 20px);
        }
        .city-item select, .city-item textarea {
            width: calc(50% - 8px);
            padding: 7px;
        }
    }
    .editable:empty:before {
        content: attr(data-placeholder);
    }
    th {
        background-color: teal;
        color: white;
    }
    td a {text-decoration: underline;}
    td a:hover {text-decoration: underline;}

    .t1_tag, .t2_tag, .t3_tag, .t4_tag {
        display: inline-block;
        padding: 3px 6px 3px 6px;
        text-align: center;
        margin: 2px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 700;
        color: white;
    }
    .t1_tag {
        background: #a0abaf;
    }
    .t1_tag_selected{
        background: #5fcd67;
    }
    .t2_tag {
        background: #ddbc95;
    }
    .t2_tag_selected{
        background: #5fcd67;
    }
    .t3_tag {
        background: #cdcdc0;
    }
    .t3_tag_selected{
        background: #5fcd67;
    }
    .t4_tag {
        background: #ebc09f;
    }
    .t4_tag_selected{
        background: #5fcd67;
    }
    .tag_selected{
        background: #5fcd67;
    }

    #wrapper {
        margin: 0 auto;
        padding: 0px;
        text-align: center;
        /*width: 995px;*/
    }

    #wrapper h1 {
        margin-top: 50px;
        font-size: 45px;
        color: #585858;
    }

    #wrapper h1 p {
        font-size: 20px;
    }

    #table_detail {
        width: 100%;
        text-align: left;
        /*border-collapse: collapse;*/
        color: #2E2E2E;
        border: #A4A4A4;
    }

    #table_detail tr {
        cursor: pointer;
    }

    #table_detail tr:hover {
        background-color: #F2F2F2;
    }

    #table_detail .hidden_row {
        display: none;
    }
</style>
</head>
<body>