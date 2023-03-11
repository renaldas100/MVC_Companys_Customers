# Klientų valdymo sistema  

Naudoto technologijos: PHP

Skurta klientų valdymo sistemą ( CRM ), kuri skirta kaupti informacijai apie klientus ir informaciją apie tai kas ir kada su klientais buvo kalbėta.

DB sudaryta trys lentelės:  
Klientai (lentelė customers) ir jų įmonių informacija (companys) (Pavyzdys: turime klientą UAB"AAA" (vienas įrašas lentelėje companys) ir iš šios įmonės bendraujame su dviem klientais Jonu ir Petru (du įrašai lentelėje customers, kurių kompanija yra nurodyta UAB"AAA").

Kiekvieną kartą pabendravę su klientu, galime užsirašyti ką bendravome su juo, tai yra kaskart pabendravę su klientu, lentelėje contact_information pridedame vieną naują įrašą su kuriuo klientu bendravome, bendravimo datą ir tekstą apie ką kalbėjome (conversation).

1. Sukurta DB su trimis lentelėmis  
2. Sukurtos trys klasės: Customer, Company ir Conversation (kiekviena klasė atitinka po vieną lentelę).  
3. Sukurti klasėms metodai, kad galėtų pridėti naujus įrašus, atnaujinti įrašus ir ištrinti įrašus.  
4. Klasėje Customer sukurtas statinis metodas : static public function getCustomers() kuris gražina visus pirkėjus.  
5. Klasėje Customer sukurti metodai: getCompany ir getConversations kurių pirmasis gražina objektą, to kliento įmonę, o antrasis gražina masyvą su objektais (pokalbių istoriją).  


Sukurkime prisijungimo sistema sistemoje.  

DB sukurta papildoma lentelė users:  
id  
email  
password  
type -varchar  

Prie skirtingų vartotojų sukurti skirtingi tipai: „superadmin“, „admin“  

Sukurta klasė Admin kuri turi šiuos metodus:  

getNavigation - grąžina masyvą su meniu punktais, kurie vėliau atvaizduojami.  

Įmonės, Darbuotojai, Pokalbiai  

statinis getUser - grąžina informaciją apie prisijungusį vartotoją  

statinis metodas login(username, password) - prisijungiama prie sistemos ir grąžinamas vartotojo objektas (SuperAdmin arba User)  

Sukurta klasė SuperAdmin kuri paveldi Admin. Sukurtas klasėje metodas getNav() kuris gražina masyvą su viršutinio meniu punktais skirtais administratoriui

Įmonės, Pridėti naują įmonę, ...Darbuotojai, Pokalbiai

Printscreens:  

![objektinis_large](https://user-images.githubusercontent.com/117721797/224485222-fed599bc-99d9-49ee-9a8c-f38960473067.png)


