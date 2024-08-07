<style>
.trigger {
    cursor: pointer;
}
.hide .target {
    display:none;
}
body {
    font-family: 'Nunito', sans-serif;
    font-size: 15px;
    margin: 0 auto 0 auto;
    padding-top: 60px;
    max-width: 992px;
    min-height: 800px;
    border-left: 1px solid;
    border-right: 1px solid;
}
a {
    text-decoration: none;
}
a:hover {
    opacity: 0.7;
}
p {
    margin: 0 !important;
}
.main ul, .main ol {
    margin: 3px 0 3px 0;
}
input[type = "submit"],
input[type = "button"],
input[type = "text"],
input[type = "select"] {
    padding: 3px;
    min-width: 100px;
}
input[type = "submit"],
input[type = "button"] {
    margin: 0 8px 0 8px;
}
input[type = "text"],
input[type = "password"],
input[type = "number"] {
    font-size: 14px;
    padding: 4px;
}
select {
    font-size: 14px;
    padding: 3px;
}
img {
    border-radius: 5px;
}
input.search, input.send {
    background: #0000cd;
    font-weight: bold;
    color: #dddddd;
}
input.post {
    background: #2e8b57;
    font-weight: bold;
    color: #dddddd;
}
input.cancel {
    background: #bcbcbc;
    font-weight: bold;
    color: #676767;
}
input.delete {
    background: #DC143C;
    font-weight: bold;
    color: #dddddd;
}
a.comment-edit {
    color: #2e8b57;
}
a.comment-delete {
    color: #DC143C;
}
label.file {
    font-size: 14px;
    background: #0000cd;
    font-weight: bold;
    color: #dddddd;
    cursor: pointer;
    padding: 3px 6px 3px 6px;
    border: 2px solid #444;
}
header {
    max-width: 992px;
    height: auto;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 10;
    display: grid;
}
.logo {
  font-size: 25px;
}
nav {
  margin: 0 0 0 auto;
}
nav > ul {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
}
header a {
  color: #ffffff;
  text-decoration: none;
  display: block;
  line-height: 60px;
  padding: 0 20px;
}
header .sm {
  display: none;
}
.grid {
    display: flex;
}
.main {
    width: 75%;
    padding: 6px 12px 6px 12px;
    min-height: 800px;
}
.main > .container {
    padding-top: 1px;
    border-bottom: 1px dotted #ddd;
}
.main > .container:last-child {
    padding-top: 8px;
    border-bottom: none;
}
.subject {
    font-size: 19px;
    font-weight: bold;
    word-break: break-all;
    padding: 12px 0px 6px 0px;
    border-bottom: 2px solid;
}
.body {
    display: flex;
    margin: 3px 0px 5px 0px;
    word-break: break-all;
}
.body > .image {
    width: 160px;
    height: auto;
    margin-right: 10px;
}
.description {
    display: grid;
    word-break: break-all;
    width: 100%;
}
.source {
    margin: 3px 0px 5px 0px;
    font-size: 14px;
    text-align: right;
    width: 100%;
    word-break: break-all;
}
.footer {
    display: flex;
}
.tags {
    margin-bottom: 10px;
    display: flex;
}
.contents {
}
.grid-contents {
    display: flex;
    padding: 10px 0 5px 0;
}
.tb-margin {
    margin: 10px 0 10px 0;
}
.vertical-contents {
    display: grid;
    padding: 5px 0 5px 0;
}
.contents-header {
    font-size: 14px;
    padding: 9px 6px 0 6px;
}
.contents .flex-contents {
    padding: 10px 0 10px 0;
}
.w-20 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 20%;
}
.w-25 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 25%;
}
.w-33 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 33%;
}
.w-50 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 50%;
}
.w-75 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 75%;
}

.profile-image {
    width: 100%;
    max-height: 165px;
    object-fit: contain;
}

span.tag {
    border:2px solid #dedede;
    border-radius: 15px;
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 2px;
    margin-right: 2px;
    font-size: 14px;
    font-weight: bold;
    color: #898989;
    white-space: nowrap;
}
.pagination {
    text-align: center;
    font-size: 20px;
    padding-top: 10px;
}
.pagination > a {
    padding: 10px;
}
.title {
    font-size: 17px;
    font-weight: bold;
    word-break: break-all;
    padding: 14px 0 2px 0;
}
.side {
    width: 25%;
    padding: 8px;
    padding-top: 8px;
}
.side > .container {
    text-align: center;
    padding: 1px 5px 3px 5px;
}
.feature-tags {
    line-height: 30px;
    text-align: center;
    border: 1px solid #bbbbbb;
    padding: 5px 3px 5px 3px;
}
.article-tags {
    line-height: 30px;
    text-align: left;
    border: 1px solid #bbbbbb;
    padding: 5px 6px 5px 6px;
}
span.ad {
    background: #dedede;
    border: 2px solid #9a9a9a;
    font-size: 10px;
    margin: 0 3px 0 0;
    padding: 0 2px 0 2px;
    position: relative;
    top: -2px;
}

.ad-sns-webapp {
    background: #ffffe0;
    border:2px solid #2e8b57;
    padding: 5px;
    text-align: left;
    font-size: 14px;
}

.hidden_radio {
    display: none;
}

input[type="radio"]:checked + label > div {
    outline:3px solid #ff0000;
}
div.radio {
    display: flex;
    font-size: 14px;
}
div.radio > label {
    padding-right: 6px;
}

/* Calendar */
#calendar {
    display: flex;
    flex-wrap: wrap;
}
#calendar table {
    border-spacing: 0;
    border-collapse: collapse;
    background: #fefefe;
    color: #565656;
}
#calendar table td {
    border: 1px solid;
    padding: 5px;
    text-align: center;
}
td.today {
    background: #ffccee;
}
#calendar > section > table th {
    border: 1px solid;
    text-align: center;
    font-size: 11px;
    height: 30px;
}

#calendar > section > table td:first-child,
#calendar > section > table th:first-child  {
    color: red;
}

#calendar > section > table td:last-child,
#calendar > section > table th:last-child {
    color: royalblue;
}

td.is-disabled {
    color: #ccc !important;
}
input#prev, input#next {
    width: 18px;
    height: 18px;
    position: relative;
    top: 3px;
}
td.calendar_td:hover {
    cursor: pointer;
    background: #bee9f7 !important;
}

/* Weather */
table.weather {
    width: 100%;
    border: 1px solid #ddd;
    border-spacing: 0;
    border-collapse: collapse;
    background: #fefefe;
    color: #565656;
}
table.weather th {
    border: 1px solid #ddd;
    background: #eee;
    text-align: center;
    font-size: 11px;
    height: 30px;
    font-weight: bold;
}
table.weather td {
    border: 1px solid #ddd;
    text-align: center;
    height: 30px;
}
table.weather img {
    width: 26px;
    height: 26px;
    position: relative;
    top: 2px;
}
table.weather .temp {
    color: #777;
    font-size: 14px;
    position: relative;
    top: -5px;
}

/* Normal Table */
table {
    width: 100%;
    border: 1px solid #ddd;
    border-spacing: 0;
    border-collapse: collapse;
}
table th {
    font-weight: bold;
    border: 1px solid;
    text-align: center;
}
table td {
    border: 1px solid #ddd;
    text-align: center;
    height: 30px;
}

/* Profiles Table */
table.info {
    width: 100%;
    border: 0px;
    border-spacing: 0;
    border-collapse: collapse;
}
table.info th {
    width: 10%;
    font-weight: bold;
    border: 0px;
    text-align: right;
    padding: 5px 5px 0 15px;
    vertical-align: top;
    font-size: 14px;
    white-space: nowrap;
}
table.info td {
    border: 0px;
    text-align: left;
}
table.info input, table.info select, table.info textarea {
    margin: 1px;
    width: auto;
}

.flex-contents {
    text-align: center;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.flex-contents > .view-item {
    text-align: center;
    display: grid;
    width: 20%;
    font-size: 14px;
}
.flex-contents > .view-item > a {
    margin: 10px;
}
.flex-contents > .image-item {
    text-align: center;
    display: grid;
    width: 25%;
    font-size: 14px;
}
.flex-contents > .image-item > a {
    margin: 10px;
}
.flex-contents > .image-item img {
    height: 7rem;
}

.flex-contents > .upload-item {
    text-align: center;
    width: 80%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.flex-contents > .upload-submit {
    text-align: center;
    width: 20%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.flex-contents > .search-item {
    text-align: center;
    width: 40%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.flex-contents > .search-submit {
    text-align: center;
    width: 20%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.search-box {
    width: auto;
    margin: 10px 0 10px 0;
    padding: 15px;
    border: 1px solid #ddd;
}
.contents-box {
    width: auto;
    margin: 10px 0 10px 0;
    padding: 15px;
    border: 1px solid #ddd;
}
.formset-box {
    width: auto;
    margin: 10px 0 10px 0;
    padding: 15px;
    border: 1px solid #ddd;
}
.alert-box {
    color: #444 !important;
    font-weight: bold;
    width: auto;
    margin: 10px 0 10px 0;
    padding: 15px;
    border: 2px solid #d00 !important;
    background: #ed9dad;
}
.info-box {
    color: #444 !important;
    font-weight: bold;
    width: 100%;
    margin: 10px 0 20px 0;
    padding: 15px;
    border: 2px solid #00bfff !important;
    background: #cddbee;
}
.post-box {
    color: #444 !important;
    font-weight: bold;
    width: 100%;
    margin: 10px 0 20px 0;
    padding: 15px;
    border: 2px solid #0d0 !important;
    background: #9dedad;
}
.normal-box {
    width: auto;
    margin: 10px 0 10px 0;
    padding: 0 15px 15px 15px;
    border: 2px solid #ddd;
    background: #fefeee;
}

.input-label{
    position: relative;
    padding: 4px 0 3px 16px;
    font-weight: bold;
    font-size: 14px;
    margin-top: 3px;
}
.input-label::before{
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    border: 5px solid transparent;
    border-left: 8px solid #9a9a9a;
}
.text-preview {
    background: #efffef;
    padding: 4px;
    border: 1px solid #cdcdcd;
    min-height: 400px;
}
.text-danger {
    color: #ff0000;
    font-size: 14px;
}
.text-primary {
    color: #0000ff;
    font-size: 14px;
}

.text-success {
    color: #008000;
    font-size: 14px;
}

.profile-articles {
    border-bottom: 1px dotted #dedede;
}
.articles-body {
    padding: 10px 4px 10px 4px;
    border-bottom: 2px dotted #acacac;
    padding-top: 0px;
    margin-bottom: 10px;
}

/* User Menus */
.user-menus {
    border: 1px solid #baba99;
}
.user-menus > ul {
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    font-size: 14px;
    text-align: left;
    border-bottom: 1px solid;
}
.user-menus > ul > section {
    font-weight: bold;
    position: relative;
    left: -18px;
}
.user-menus > ul:last-child {
    border-bottom: none;
}

/* Admin Menus */
.admin-menus {
    border: 1px solid #baba99;
}
.admin-menus > ul {
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    font-size: 14px;
    text-align: left;
    border-bottom: 1px solid;
}
.admin-menus > ul > section {
    font-weight: bold;
    position: relative;
    left: -18px;
}
.admin-menus > ul:last-child {
    border-bottom: none;
}

/* User Managements */
table.table-managements {
    font-size: 14px;
}

table.table-managements th {
}

table.table-managements .left {
    text-align: left;
    padding: 0 5px 0 5px;
}

table.table-managements tr.under {
    border-bottom: 2px dotted #cccccc;
}

/* ステータスラベル */
span.enable {
    background: #228B22;
    color: #efefef;
    font-weight: bold;
    font-size: 12px;
    padding: 1px 5px 1px 5px;
    border-bottom: 2px solid #116911;
    border-radius: 6px;
}
span.disable {
    background: #979797;
    color: #efefef;
    font-weight: bold;
    font-size: 12px;
    padding: 1px 5px 1px 5px;
    border-bottom: 2px solid #565656;
    border-radius: 6px;
}

/* 四角いラベル */
span.sq-green {
    background: #228B22;
    color: #efefef;
    font-weight: bold;
    font-size: 12px;
    padding: 1px 5px 1px 5px;
    border: 1px solid #116911;
    border-radius: 4px;
}

span.sq-gray {
    background: #ababab;
    color: #efefef;
    font-weight: bold;
    font-size: 12px;
    padding: 1px 5px 1px 5px;
    border: 1px solid #565656;
    border-radius: 4px;
}

.comment {
    margin: 0 0 6px 0;
    padding: 0 0 4px 0;
    border-bottom: 1px solid #baba99;
}
textarea[name="comment"] {
    width: 100%;
    padding: 5px;
    margin-top: 10px;
    resize:vertical;
}

/** マイページ */
.mypage input[type = "text"],
.mypage input[type = "password"] {
    width: auto;
}

/** タブコントロール */
.tab-wrap {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-around;
}
.tab-label {
    color: white;
    width: 33%;
    background: LightGray;
    margin: 10px 0 10px 0;
    padding: 5px 0 5px 0;
    order: -1;
    text-align: center;
}
.tab-content {
    width: 100%;
    display: none;
}
.tab-switch:checked+.tab-label {
    background: DeepSkyBlue;
}
.tab-switch:checked+.tab-label+.tab-content {
     display: block;
}
.tab-switch {
    display: none;
}

/** トップへ戻る */
#pagetop {
    position: fixed;
    right: 10px;
    bottom: 10px;
    margin: 0;

}
#pagetop a{
    position: relative;
    display: flex;
    width: 60px;
    height: 60px;
    justify-content: center;
    transition: opacity .6s ease;
    color: #FFF;
    align-items: center;
    text-decoration: none;
    font-size: 40px;
    border-radius:100%;
}
#pagetop a:hover {
    opacity: .3;
}
@media screen and (max-width:767px) {
    #pagetop a {
        width: 50px;
        height: 50px;
    }
}

@media only screen and (max-width:991px) {
    .grid {
        display: grid;
    }
    .main {
        width: auto;
    }
    .side {
        width: auto;
        display: grid;
        grid-template-columns: repeat(2 , 1fr);
    }
    .side > .container {
        width: auto;
    }
    #calendar > section > table th {
        font-size: 15px;
    }
    table.weather th {
        font-size: 15px;
    }
}

@media (max-width: 638px) {
    .side {
        display: grid;
        grid-template-columns: repeat(1 , 1fr);
    }
    .side > .container {
        width: auto;
    }
    .main > .footer {
        display: grid;
    }
    .pc {
        display: none !important;
    }
    #hamburger {
        background-color: transparent;
        position: relative;
        cursor: pointer;
        margin: 0 0 0 auto;
        height: 60px;
        width: 60px;
    }
    .icon span {
        position: absolute;
        left: 15px;
        width: 30px;
        height: 4px;
        background-color: white;
        border-radius: 8px;
        transition: ease 0.75s;
    }
    .icon span:nth-of-type(1) {
        top: 16px;
    }
    .icon span:nth-of-type(2) {
        top: 28px;
    }
    .icon span:nth-of-type(3) {
        bottom: 16px;
    }
    .close span:nth-of-type(1) {
        transform: rotate(45deg);
        top: 28px;
    }
    .close span:nth-of-type(2) {
        opacity: 0;
    }
    .close span:nth-of-type(3) {
        transform: rotate(-45deg);
        top: 28px;
    }
    .sm {
        top: 60px;
        left: 0px;
        position: absolute;
        z-index: 10;
        width: 100%;
        background-color: rgba(34, 49, 52, 0.9);
    }
    nav ul{
        display: inline-block;
        width: 100%;
        list-style: none outside;
        padding: 0;
        margin: 0;
    }
    nav li{
        padding: 0;
        margin: 0;
        float: left;
        width: 50%;
        box-sizing: border-box;
    }
    nav li:nth-child(odd) {
        border-right: 1px solid #ddd;
    }
    .nav-title {
        color: #cccccc;
        font-weight: bold;
        padding: 10px 0 10px 0;
        border: 0;
    }
    header {
        top: -1px;
        left: -1px;
    }
    header ul {
        flex-direction: column;
    }
    header a {
        text-align: center;
        border-top: solid 0.5px rgba(255, 255, 255, 0.6);
    }
    .grid-contents {
        display: grid;
    }
    .grid-contents > div {
        display: table;
    }
    .w-20 {
        width: auto;
        text-align: center;
    }
    .w-25 {
        width: auto;
        text-align: center;
    }
    .w-33 {
        width: auto;
    }
    .w-50 {
        width: auto;
    }
    .w-75 {
        width: auto;
    }
    .profile-image {
        width: 60%;
        max-height: 220px;
    }
    .flex-contents > .view-item {
        width: 33%;
    }
    .flex-contents > .image-item {
        width: 50%;
    }
    .flex-contents > .search-item {
        width: 100%;
    }
    .flex-contents > .search-submit {
        width: 100%;
    }
    table.info th, table.info td{
      display: block;
    }
    table.info th{
        position: relative;
        padding: 5px 0 3px 16px;
        font-weight: bold;
        font-size: 14px;
    }
    table.info th::before{
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left: 8px solid #9a9a9a;
    }
    /** Mypage */
    .mypage input[type = "text"],
    .mypage input[type = "password"] {
        width: 95%;
    }
}

/** Theme */
body {
    background: {{$settings['body_color']}} !important;
    color: {{$settings['text_color']}} !important;
    border-color: {{$settings['border_color']}} !important;
}
.main, .side, .pagination {
    background: {{$settings['background_color']}} !important;
}
header {
    background: {{$settings['header_color']}} !important;
    border-left:1px solid {{$settings['border_color']}} !important;
    border-right:1px solid {{$settings['border_color']}} !important;
}
.nav-title, #pagetop a {
    background: {{$settings['header_color']}} !important;
}
div, table, td, ul, th:not(.xdsoft_calendar > table) {
    border-color: {{$settings['border_color']}} !important;
}
table th:not(.xdsoft_calendar > table th) {
    background: {{$settings['th_color']}};
}
table td:not(.xdsoft_calendar > table td) {
    background: {{$settings['background_color']}} !important;
}
table.info th {
    background: {{$settings['background_color']}} !important;
}
.user-menus, .admin-menus, .feature-tags {
    background-color: {{$settings['box_color']}}88 !important;
}
.contents-box {
    background-color: {{$settings['th_color']}} !important;
}
.search-box, .formset-box {
    background-color: {{$settings['contents_color']}} !important;
}
a {
    color: {{$settings['a_color']}};
}
</style>
