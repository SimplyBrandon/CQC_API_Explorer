<!doctype html>
<html>
  <head>
    <title>CQC API Explorer</title>
    <style type="text/css">
      body {
	font-family: Trebuchet MS, sans-serif;
	font-size: 15px;
	color: #444;
	margin-right: 24px;
}

h1	{
	font-size: 25px;
}
h2	{
	font-size: 20px;
}
h3	{
	font-size: 16px;
	font-weight: bold;
}
hr	{
	height: 1px;
	border: 0;
	color: #ddd;
	background-color: #ddd;
}

.app-desc {
  clear: both;
  margin-left: 20px;
}
.param-name {
  width: 100%;
}
.license-info {
  margin-left: 20px;
}

.license-url {
  margin-left: 20px;
}

.model {
  margin: 0 0 0px 20px;
}

.method {
  margin-left: 20px;
}

.method-notes	{
	margin: 10px 0 20px 0;
	font-size: 90%;
	color: #555;
}

pre {
  padding: 10px;
  margin-bottom: 2px;
}

.http-method {
 text-transform: uppercase;
}

pre.get {
  background-color: #0f6ab4;
}

pre.post {
  background-color: #10a54a;
}

pre.put {
  background-color: #c5862b;
}

pre.delete {
  background-color: #a41e22;
}

.huge	{
	color: #fff;
}

pre.example {
  background-color: #f3f3f3;
  padding: 10px;
  border: 1px solid #ddd;
}

code {
  white-space: pre;
}

.nickname {
  font-weight: bold;
}

.method-path {
  font-size: 1.5em;
  background-color: #0f6ab4;
}

.up {
  float:right;
}

.parameter {
  width: 500px;
}

.param {
  width: 500px;
  padding: 10px 0 0 20px;
  font-weight: bold;
}

.param-desc {
  width: 700px;
  padding: 0 0 0 20px;
  color: #777;
}

.param-type {
  font-style: italic;
}

.param-enum-header {
width: 700px;
padding: 0 0 0 60px;
color: #777;
font-weight: bold;
}

.param-enum {
width: 700px;
padding: 0 0 0 80px;
color: #777;
font-style: italic;
}

.field-label {
  padding: 0;
  margin: 0;
  clear: both;
}

.field-items	{
	padding: 0 0 15px 0;
	margin-bottom: 15px;
}

.return-type {
  clear: both;
  padding-bottom: 10px;
}

.param-header {
  font-weight: bold;
}

.method-tags {
  text-align: right;
}

.method-tag {
  background: none repeat scroll 0% 0% #24A600;
  border-radius: 3px;
  padding: 2px 10px;
  margin: 2px;
  color: #FFF;
  display: inline-block;
  text-decoration: none;
}

    </style>
  </head>
  <body>
  <h1>CQC API Explorer</h1>
    <div class="app-desc">API For retrieving and storing CQC Providers</div>
    <div class="app-desc">More information: <a href="https://helloreverb.com">https://helloreverb.com</a></div>
    <div class="app-desc">Contact Info: <a href="brandonsmithian@gmail.com">brandonsmithian@gmail.com</a></div>
    <div class="app-desc">Version: 1.0.0</div>
    <div class="app-desc">BasePath:/BRANDONSMITHIAN_1/CQC_API/1.0.0</div>
    <div class="license-info">Apache 2.0</div>
    <div class="license-url">http://www.apache.org/licenses/LICENSE-2.0.html</div>
  <h2>Access</h2>

  <h2><a name="__Methods">Methods</a></h2>
  [ Jump to <a href="#__Models">Models</a> ]

  <h3>Table of Contents </h3>
  <div class="method-summary"></div>
  <h4><a href="#Public">Public</a></h4>
  <ul>
  <li><a href="#providersGet"><code><span class="http-method">get</span> /providers</code></a></li>
  </ul>

  <h1><a name="Public">Public</a></h1>
  <div class="method"><a name="providersGet"/>
    <div class="method-path">
    <a class="up" href="#__Methods">Up</a>
    <pre class="get"><code class="huge"><span class="http-method">get</span> /providers</code></pre></div>
    <div class="method-summary">Returns the providers API endpoint from CQC (<span class="nickname">providersGet</span>)</div>
    <div class="method-notes">A paginated list of providers as returned from the CQC API.
By passing the page and perPage query params, we can navigate the pagination.</div>





    <h3 class="field-label">Query parameters</h3>
    <div class="field-items">
      <div class="param">page (optional)</div>

      <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; pass an optional page number to view format: int32</div><div class="param">perPage (optional)</div>

      <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; number of records per page to view format: int32</div>
    </div>  <!-- field-items -->


    <h3 class="field-label">Return type</h3>
    <div class="return-type">
      array[<a href="#Providers">Providers</a>]
      
    </div>

    <!--Todo: process Response Object and its headers, schema, examples -->

    <h3 class="field-label">Example data</h3>
    <div class="example-data-content-type">Content-Type: application/json</div>
    <pre class="example"><code>{}</code></pre>

    <h3 class="field-label">Produces</h3>
    This API call produces the following media types according to the <span class="header">Accept</span> request header;
    the media type will be conveyed by the <span class="header">Content-Type</span> response header.
    <ul>
      <li><code>application/json</code></li>
    </ul>

    <h3 class="field-label">Responses</h3>
    <h4 class="field-label">200</h4>
    search results matching criteria
        
  </div> <!-- method -->
  <hr/>

  <h2><a name="__Models">Models</a></h2>
  [ Jump to <a href="#__Methods">Methods</a> ]

  <h3>Table of Contents</h3>
  <ol>
    <li><a href="#Provider"><code>Provider</code> - </a></li>
    <li><a href="#Providers"><code>Providers</code> - </a></li>
  </ol>

  <div class="model">
    <h3><a name="Provider"><code>Provider</code> - </a> <a class="up" href="#__Models">Up</a></h3>
    <div class='model-description'></div>
    <div class="field-items">
      <div class="param">providerId </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: 1-10000227676</span></div>
<div class="param">providerName </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: Healthcare Employment Partners Ltd</span></div>
    </div>  <!-- field-items -->
  </div>
  <div class="model">
    <h3><a name="Providers"><code>Providers</code> - </a> <a class="up" href="#__Models">Up</a></h3>
    <div class='model-description'></div>
    <div class="field-items">
      <div class="param">total </div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: 50000</span></div>
<div class="param">firstPageUri </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: /providers?page=1&perPage=1000</span></div>
<div class="param">page </div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: 1</span></div>
<div class="param">previousPageUri </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
<div class="param">lastPageUri </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: /providers?page=54&perPage=1000</span></div>
<div class="param">nextPageUri </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: /providers?page=2&perPage=1000</span></div>
<div class="param">perPage </div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: 1000</span></div>
<div class="param">totalPages </div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span>  </div>
          <div class="param-desc"><span class="param-type">example: 54</span></div>
<div class="param">providers </div><div class="param-desc"><span class="param-type"><a href="#Provider">Provider</a></span>  </div>
    </div>  <!-- field-items -->
  </div>
  </body>
</html>
