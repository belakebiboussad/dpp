CREATE VIEW nextRdvs AS
SELECT `rdvs`.id,`rdvs`.date,`rdvs`.patient_id as `patientId` ,`patients`.IPP,`patients`.Nom,`patients`.Prenom,`specialites`.nom as `specialite`
FROM (`rdvs`)
INNER JOIN  patients ON (`rdvs`.patient_id = patients.id)
INNER JOIN  specialites ON (`rdvs`.specialite = specialites.id)
WHERE (rdvs.date between CURDATE() 
AND DATE_ADD(CURDATE(),INTERVAL 1 DAY))ORDER BY date DESC