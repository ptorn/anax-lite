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

                <h3>Allmänt:</h3>
                <p>Hade gärna gjort mer på momentet, men jag kände att jag inte hade tid att göra alla extrauppgifterna. Men jag filade lite på navbaren så den kunde hantera undermenyer vilket jag gjorde med hjälp utav en rekursivfunktion.</p>
                <p>Till Kalendern så la jag till att man har olika bilder för varje månad samt veckonummerna.</p>

                <h3>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?</h3>
                <p>Tycker det kändes bra. Det finns fördelar med att koda i ramverket som tex hur jag valde att göra session en del utav $app så att jag kan nyttja session på alla sidorna. Men jag valde att låta kalendern instansieras i routen och då enbart skapas när man väljer att kika på kalendern.  Fördelarna är ju att man inte behöver exponera hela ramverket för sidor som inte är intresserade utav alla delarna utan delarna som alla vill ha kan man lägga i ramverket.</p>

                <h3>Hur väljer du att organisera dina vyer?</h3>
                <p>Jag har kört på som efterfrågats och lagt dom i take1 och navbar2. Kod som återkommer på alla sidorna som header, banner, byline och footer har jag delat upp i egna filer som inkluderas i routerna. Sen har varje sida sin egen view som home, report, calendar, about, session, test, dump.</p>
                <p>Logiken håller jag i klasserna för att hålla mina vyer rena. I kalender vyn så kollar jag get variablerna annars är det bara utskrifter.</p>

                <h3>Berätta om hur du löste integreringen av klassen Session.</h3>
                <p>Tanken jag hade var att jag ville kunna utnyttja session-klassen över hela sidan så då föll det sig naturligt att lägga den i $app->session så att den blir en del utav ramverket. Det gör jag i min indexfil när jag instansierar övriga objekt till ramverket. Sen skapade jag en egen session routfil som importeras till ”config/route/base”. I routen så löser jag lite logik direkt eftersom man bara ska  vidarebefordras tillbaka. Först var jag lite vilsen på hur jag skulle lösa det, men jag kikade runt i modulerna som vi hade i vendor/anax där vi redan har initerat dessa objekt i ramverket så jag tänkte att dom kan jag använda. Då fann jag respons->redirect och respons->sendJson som hjälpte mig att lösa uppgiften. Tex Json-objektet skapade jag i routen och skickade en respons->sendJson.</p>

                <h3>Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</h3>
                <p>Här valde jag att göra uppgiften med månadskalendern då jag tyckte att den kändes mer användbar för mig. Jag började med att bygga upp klassen Calendar i src mappen och la till den i mitt namespace. Jag tänkte från början att jag tyckte det var onödigt att ta med den i ramverket från början så jag instansierar kalenderobjektet i routen Calendar och skickar med den som en variabel som innehåller objektet till min view där jag kan anropa outputHtmlTable() på objektet. Så nu har jag inget med $app att göra beträffande kalendern utan den är helt fristående.</p>
                <p>Sen när jag hade en fungerande kalender så tänkte jag att vi skulle ju göra det lite mer objektorienterat så då kände jag att månad var något som jag kunde dela från kalendern då en kalender består utav flera månader så jag skapade klassen Month som jag använder i min klass Calendar. Logiken för att hantera en månad ligger i Month. Det var smidigt att göra så när man samtidigt ville ha information om månaden före och månaden efter så då kunde jag skapa objektet före och efter beroende på den månaden som var aktiv och genast få tillgång till användbar data. Sen valde jag mig utav att använda mig utav GET variabler för jag såg fördelar med att kunna ha urler direkt till en månad.</p>

                <h3>Några tankar kring SQL så här långt?</h3>
                <p>Tycker det känns bra. Man inser att det går att organisera och sammanställa data på ett smidigt och effektivt sätt. Samtidigt blir det mer påtagligt om jag återkopplar till en tidigare föreläsning där Mikael Roos går in på att var sak ska göra sitt. En halv taskig programmerare kanske gör ett generellt anrop till databasen och hämtar hem allt och sedan behandlar den data i det språk som man jobbar i istället för att fråga databasen rätt från början så man får det man vill ha som man vill ha det. Smidigare med om man jobbar på större system där kanske databasen ligger på en annan server så man inte belastar exempelvis webbservern för mycket genom att låta den göra allt jobb. Är en god ide att låta databasen jobba lite också.</p>

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
