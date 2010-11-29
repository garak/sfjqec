sfjqec
======

Questo progetto symfony, basato su [symfony 1.4](http://www.symfony-project.org/) e
[Propel 1.5](http://www.propelorm.org/), è stato creato a scopo didattico, per una
presentazione tenuta alla riunione del [PUG Roma](http://roma.grusp.org/) del 24 novembre
2010. Lo scopo di questo codice è in generale mostrare come integrare correttamente
Javascript e PHP, con particolare riferimento a symfony e jQuery.
Il progetto mostra un semplicissimo e-commerce, da cui il nome: sfjqec è formato da
sf (symfony) + jq (jQuery) + ec (e-commerce).

in breve
--------

In estrema sintesi, questo progetto mostra come integrare correttamente Javascript e PHP,
usando AJAX. I passi sono i seguenti:

  * scrivere l'applicazione come se Javascript non esistesse
  * legare alcuni eventi (tipicamente click di link e submit di form) a delle funzioni
    Javascript
  * ciascuna di queste funzioni Javascript richiama uno script PHP, tramite AJAX
  * al successo della chiamata AJAX, richiama un'altra funzione Javascript, che si occupa
    di manipolare il DOM
 
Nello specifico di Jquery e symfony, i passi si traducono nel seguente modo:

  * scrivere il controller normalmente
  * scrivere un file Javascript che usi l'evento `ready()` di jQuery e che faccia il `bind`
    dei click e dei submit necessari.
  * usare l'evento passato da `bind` nella funzione Javascript per estrarre i riferimenti
    necessari
  * nel controller, effettuare le necessarie modifiche (spesso basta modificare i redirect,
    in modo che NON siano effettuati per le richieste AJAX
  * nella vista, aggiungere un file del tipo `NomeAzioneSuccess.json.php`
  * di nuovo nel file Javascript, scrivere la funzione che deve manipolare il DOM,
    basandosi sulla variabile `result`, che a questo punto contiene un oggetto JSON, che
    jQuery ricava dal codice della vista del punto precedente
  
A questo punto il mio consiglio è quello di analizzare i passi precedenti, tenendo
sott'occhio il codice di questo progetto, in particolare il controller e il file js.
