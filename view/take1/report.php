<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>OOPHP - Redovisning</h1>

                <h2>Kmom01</h2>

                <h3>Allmänt</h3>
                <p>Det var ett rätt matigt Kmom med rätt många uppgifter. Kanske inget som var svårt utan tog mest lite mer tid än vanligt. Men nyttigt att få friska upp minnet.</p>
                <p>Guessuppgiften har en enkel stil som går i blått och grått. Jag skapade en egen klass för att hantera GuessException som ärver från Exception. Sen delade jag upp koden där alla sidorna delar på samma konfigurationsfil och header.php som inkluderas. Jag använder mig utav getOnce() för att rensa min sessionsvariabel så det inte skulle bli problem vid header() anropet för att undvika att den inte gissar med samma värde igen. Jag skapade även en funktion i klassen Session som tömmer sessionen så man kan börja om igen.</p>

                <p>Nu till Anax-lite här valde jag att jobba med Makefiler och LESS som vi gjorde i designkursen. Anledningen till att jag valde detta var för att dels hålla den röda tråden genom utbildningen och för att jobba på mer med Makefiler och LESS så jag blir lite bekvämare med det. Jag fick installera lite paket från npm som vi gjort tidigare i designkursen med verktygen som behövs för att kunna kompilera LESS.</p>
                <p>Mina bilder hanteras utav Cimage så dom är inte större än vad dom behöver som man kan se på min byline som exempel. Jag skapade även en byline och banner bild som syns på alla sidorna.</p>
                <p>Skapade även en testsida för framtida tester som man kan komma åt från huvudmenyn.</p>
                <p>Min navbar har en konfigurationsfil som ligger i mappen ”config” som innehåller en lista av data för mina länkar. Dessa importerar jag till min view-fil för navbaren som innehåller funktioner för att hantera hur länkarna ska visas och inkluderas på sidan.</p>

                <h3>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</h3>
                <p>Det kändes bra. Steget att gå från objektorientering i Python till PHP kändes bra då man kände att man fått jobba på med objekt och hur man använder dom. Man börjar vänja sig vid att hoppa mellan olika språk nu. Efter att gå igenom uppfräschningen oophp20 så var man igång i PHP igen.</p>

                <h3>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</h3>
                <p>Om jag börjar reflektera omkring ramverk så känner jag att det är en uppdelning utav koden som gör det lättare att styra funktionaliteten när man separerar data med funktionaliteten. Konfigurationsfilerna ligger på sin plats vilket gör det enkelt att redigera. Koden blir snyggare och mer strukturerad vilket gör det lättare att underhålla.</p>
                <p>Sen kikade jag runt i klasserna/objekten som vi injektar i vårt $app objekt mest för att försöka förstå hur det hänger ihop. Som hur det kommer sig att vi har $app tillgängligt i våra viewfiler. Det händer endel som man inte har riktigt koll på där, men det klarnar lite mer när man kikar runt bland filerna.</p>

                <h3>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?</h3>
                <p>Det gick bra. Inga konstigheter än så länge. Jag gjorde den första tredjedelen vilket inte var så svårt. SQL labben som vi gjorde i htmlphp var nyttig känner jag. Den kände jag att jag fick bättre koll på SQL så man känner igen sig. Innan kursen htmlphp så har jag varit inne i databaser och rotat i samband med diverse olika CMS-system, men aldrig riktigt gått in på djupet. Mest löst några saker och sen lämnat det.</p>

                <h2>Kmom02</h2>
                <p>Lite text framöver.</p>

                <h2>Kmom03</h2>
                <p>Lite text framöver.</p>

                <h2>Kmom04</h2>
                <p>Lite text framöver.</p>

                <h2>Kmom05</h2>
                <p>Lite text framöver.</p>

                <h2>Kmom06</h2>
                <p>Lite text framöver.</p>

                <h2>Kmom 07/10</h2>
                <p>Lite text framöver.</p>
            </main>
        </div>
    </div>
</div>
