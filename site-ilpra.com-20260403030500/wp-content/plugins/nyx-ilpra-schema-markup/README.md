# NYX ILPRA Schema Markup

Plugin WordPress indipendente per il markup JSON-LD ILPRA.

## Installazione

1. Caricare e attivare il plugin su `ilpra.com` e `it.ilpra.com`.
2. Aprire `Impostazioni > NYX Schema Markup`.
3. Verificare i dati aziendali precompilati.
4. Impostare la lingua e l'URL della pagina contatti dell'installazione corrente.

Su `ilpra.com`:

- Lingua: `en`
- URL contatti: la pagina inglese Contatti.

Su `it.ilpra.com`:

- Lingua: `it-IT`
- URL contatti: la pagina italiana Contatti.

## Markup generato

- `Organization`: in tutto il sito, con ID canonico `https://ilpra.com/#organization`.
- `Product`: in ogni singola `packaging_machine`. Legge titolo, URL, immagine, descrizione, categoria macchina e tabella tecnica ACF `dati_tecnici`. Le etichette generiche, come `ILPRA Group`, non vengono usate come categoria prodotto.
- `FAQPage`: in ogni singola `packaging_machine` che contiene almeno una FAQ completa nel repeater ACF `machine_faq_items`. Usa le stesse domande e risposte visibili nella pagina e si collega al relativo `Product`.
- `NewsArticle`: nei post WordPress con categoria `news`. Legge titolo, URL, immagine, date, lingua e la stessa meta description elaborata da Slim SEO.

Quando Slim SEO e attivo, il plugin ne disabilita solo il modulo `schema`: title, meta description, canonical, Open Graph e sitemap restano gestiti da Slim SEO. In questo modo il JSON-LD viene stampato solo dal plugin NYX e non ci sono entita duplicate.

Il plugin non inventa prezzi, disponibilita, codici prodotto, audience, about o keyword non presenti nei contenuti.

## Verifica

Dopo la pubblicazione verificare almeno una macchina e una news con il test dei risultati avanzati di Google e il validator Schema.org. Nel codice sorgente di ogni pagina deve essere presente un solo blocco JSON-LD per ogni entita gestita dal plugin.
