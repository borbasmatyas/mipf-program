# Made in Pécs fesztivál program

Személyes, nem hivatalos programnézet a Made in Pécs Fesztivál eseményeihez. A frontenden egy CSS grid alapú, kanban-szerű időrács jelenik meg, a programok kiemelhetők, megoszthatók (lennének ha megcsináltam volna), és a lejárt vagy elmaradó események vizuálisan jelölve vannak.

## Fő funkciok
- Programok megjelenítése időrácsban helyszínenként.
- Aktuális idő jelölése vonallal, lejárt események halványítása.
- Események kiemelése kattintással és mentése cookie-ba (7 nap).
- Megosztás saját vagy barátok kiemelt eseményeivel URL-en keresztül. _(Ez még nincs kész)_
- Elmaradt események jelölése.


## Adatforras
A programokat a `data-source/program-json.php` a `https://madeinpecsfesztival.hu/programok/` oldalról olvassa ki, majd JSON-ként adja vissza. 
_Ez lehetne tisztán JavaScript, ha a madeinpecsfesztival.hu CORS konfigurációja engedné. Így viszont PHP..._

A beállítható paraméterek között van az esemény dátuma, a kezdőidő és az alap eseményhossz.

---

A "Made in Pécs fesztivál" logó és név, valamint a betűtípus a fesztivál szervezőjének tulajdona.
[madeinpecsfesztival.hu](https://madeinpecsfesztival.hu)