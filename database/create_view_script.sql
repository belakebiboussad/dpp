CREATE VIEW nextRdvs AS
SELECT `rdvs`.id,`rdvs`.Date_RDV,`rdvs`.Patient_ID_Patient as `patientId` ,`patients`.IPP,`patients`.Nom,`patients`.Prenom,`specialites`.nom as `specialite`
FROM (`rdvs`)
INNER JOIN  patients ON (`rdvs`.Patient_ID_Patient = patients.id)
INNER JOIN  specialites ON (`rdvs`.specialite = specialites.id)
WHERE (rdvs.Date_RDV between CURDATE() 
AND DATE_ADD(CURDATE(),INTERVAL 1 DAY))ORDER BY Date_RDV DESC