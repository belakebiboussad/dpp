<script type="text/Javascript" >
   function ajout(element){
      var formulaire = window.document.formulaireDynamique;
      // On clone le bouton d'ajout
      var ajout = element.cloneNode(true);
      // Crée un nouvel élément de type "input"
      var champ = document.createElement("input");
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = "champs[]";
      champ.type = "text";
      var sup = document.createElement("input");
      sup.value = "supprimer un champ";
      sup.type = "button";
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this);};
 
      // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.
      var bloc = document.createElement("p");
      bloc.appendChild(champ);
      formulaire.insertBefore(ajout, element);
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
   }
 
function suppression(element){
   var formulaire = window.document.formulaireDynamique;
   // Supprime le bouton d'ajout
   formulaire.removeChild(element.previousSibling);
   // Supprime le champ
   formulaire.removeChild(element.nextSibling);
   // Supprime le bouton de suppression
   formulaire.removeChild(element);
}
</script>