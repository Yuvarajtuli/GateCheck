select ZZ.day,isnull(AA.visiters,0) as [visiters],isnull(BB.feedbacks,0) [feedbacks] from (
	select Left(DATENAME(WEEKDAY,value),3) as [day] from generate_series(0,6)
) as ZZ 
left join (
	select left(datename(WEEKDAY,entryTime),3) as [visitDay], COUNT(*) as [visiters] 
	from visitorLog where MONTH(entryTime) = MONTH(GETDATE()) group by datename(WEEKDAY,entryTime)
) as AA 
on AA.visitDay=ZZ.day
left join (
	select left(datename(WEEKDAY,feedbackTime),3) as feedbackDay, COUNT(*) as [feedbacks] 
	from feedback where MONTH(feedbackTime) = MONTH(GETDATE()) group by datename(WEEKDAY,feedbackTime)
) as BB 
on BB.feedbackDay = ZZ.day