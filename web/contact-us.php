<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{DV.Campus} PHP Framework</title>
    <style>
        header,
        main,
        footer {
            border: 1px dashed black;
        }

        .product-list {
            display: flex;
        }

        .product-list .product {
            max-width: 30%;
        }
    </style>
</head>
<body>
    <header>
        <a href="/" title="{DV.Campus} PHP Framework">
            <img src="logo.jpg" alt="{DV.Campus} Logo" width="200"/>
        </a>
        <menu>
            <li>Category 1</li>
            <li>Category 2</li>
            <li>Category 3</li>
            <li>Category 4</li>
        </menu>
    </header>

    <main>
        <form method="post" action="/send-contact-us-request">
            <h2>Contact Us</h2>
            <div class="field">
                <label for="contact-name">Your name:</label>
                <input type="text" id="contact-name" placeholder="John Doe">
            </div>
            <div class="field">
                <label for="contact-email">Your email:</label>
                <input type="email" id="contact-email" placeholder="email@example.com">
            </div>
            <div class="field">
                <label for="contact-question">Question:</label>
                <textarea id="contact-question" rows="4" placeholder="Please, enter your question"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </main>

    <footer>
        <nav>
            <ul>
                <li>
                    <a href="/about-us">About Us</a>
                </li>
                <li>
                    <a href="/terms-and-conditions">Terms & Conditions</a>
                </li>
                <li>
                    <a href="/contact-us">Contact Us</a>
                </li>
            </ul>
        </nav>
        <p>© Default Value 2021. All Rights Reserved.</p>
    </footer>
</body>
</html>
