<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        html, body {
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: sans-serif;
            font-size: 14px;
        }
        body {
            display: -webkit-flex;
            display: flex;

            -webkit-flex-direction: row;
            flex-direction: row;
        }
        h1, h2, h3, h4 {
            font-weight: normal;
        }

        section.saved {
            display: -webkit-flex;
            -webkit-flex-direction: column;
            flex-direction: column;
            -webkit-flex: 0 1 200px;
            flex: 0 1 200px;
            z-index: 999;
            box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.2);
        }
        section.saved header {
            -webkit-flex: 0 0 auto;
            z-index: 999;
            box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.1);
        }
        section.saved h3 {
            line-height: 30px;
            margin: 0;
            padding: 0 0 0 10px;
        }
        section.saved ol {
            overflow-y: auto;
            min-height: 0;
        }
        section.saved li {
            cursor: pointer;
            transition: background-color 200ms;
        }
        section.saved li:hover {
            background-color: #EEF;
        }
        section.saved li:active {
            background-color: #DDF;
        }
        section.saved li.active,
        section.saved li.active:hover,
        section.saved li.active:active {
            background-color: #44F;
            color: #FFF;
        }

        section.edit {
            -webkit-flex: 1 3 600px;
            flex: 1 3 600px;
            background-color: #CCC;
            overflow-y: auto;
        }
        section.edit section {
            background-color: #FFF;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 1px 2px 2px rgba(0, 0, 0, 0.2);
        }

        section.actions:after {
            content: "";
            display: table;
        }
        section.actions:after {
            clear: both;
        }

        section.items select {
            float: left;
            margin: 2px 0;
        }
        section.items input, 
        section.items textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            margin: 2px 0;
        }

        button.plus,
        button.minus,
        button.up,
        button.down {
            float: right;
            width: 30px;
            font-size: 20px;
        }
        button.plus:after {
            content: "+";
        }
        button.minus:after {
            content: "-";
        }
        button.up:after {
            content: "\25B4";
        }
        button.down:after {
            content: "\25BE";
        }

        ul, ol {
            margin: 0;
            padding: 0;
        }
        li {
            list-style-type: none;
            margin: 0;
            padding: 10px;
        }
        button {
            
            display: block;
            float: right;
            cursor: pointer;

            appearance: none;
            -moz-appearance: none; /* Firefox */
            -webkit-appearance: none; /* Safari and Chrome */
            
            border: 0;
            background: #DDF;
            height: 30px;
            line-height: 30px;

            transition: background-color 200ms;
        }
        button:hover {
            background-color: #CCF;
        }
        button:active {
            background-color: #BBE;
        }

        form h1 {
            display: block;
            font-size: 125%;
            border-bottom: 1px solid #CCC;
            margin: 10px 0;
            padding: 0;
        }
        label {
            display: inline-block;
            width: 100px;
            line-height: 20px;
            vertical-align: top;
            margin: 4px 0;
        }
        input, select {
            line-height: 20px;
            font-size: inherit;
            padding: 2px;
            margin: 2px;
        }
        textarea {
            font-family: sans-serif;
            font-size: inherit;
            width: 300px;
            height: 60px;
            padding: 2px;
            margin: 2px;
        }
    </style>
    <script src="http://code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/revuemail/markdown.min.js"></script>
    <script type="text/javascript">
        $(function(){
            window.item_template = $('section.items ol li').html()
        })
    </script>
    <script type="text/javascript" src="/assets/revuemail/index.js"></script>
</head>
<body>
    <section class="saved">
        <header>
            <button title="Create New Email" class="plus"></button>
            <button title="Delete Current Email" class="minus"></button>
            <h3>Saved Emails</h3>
        </header>
        <ol>
        </ol>
    </section>
    <section class="edit">
        <form>
            <section class="header_and_footer">
                <h1>Header and Footer</h1>
                <div>
                    <label>Heading</label>
                    <input name="heading" type="text" value="CSE Revue News" />
                </div>
                <div>
                    <label>Subheading</label>
                    <input name="subheading" type="text" value="Week 2 S1 2014" />
                </div>
                <div>
                    <label>Greeting</label>
                    <input name="greeting" type="text" value="Hey guys," />
                </div>
                <div>
                    <label>Signature</label>
                    <textarea name="signature">Thanks guys,
Your Secretive Secretary,
Lozza.</textarea>
                </div>
            </section>
            <section class="items">
                <button title="Create New Item" class="plus"></button>
                <h1>Items</h1>
                <ol>
                    <li>
                        <button class="minus"></button>
                        <button class="up"></button>
                        <button class="down"></button>
                        <select name="type">
                            <option value="announcement">Announcement</option>
                            <option value="event">Event</option>
                            <option value="callout">Callout</option>
                        </select>
                        <input name="heading" type="text" placeholder="Heading" />
                        <textarea name="body"></textarea>
                    </li>
                </ol>
            </section>
            <section class="actions">
                <button id="generate">Save &amp; Generate</button>
            </section>
        </form>
    </section>
</body>
</html>
