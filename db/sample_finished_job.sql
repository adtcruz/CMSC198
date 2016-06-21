-- insert sample finished jobs
UPDATE job SET startDate = CURDATE(), finishDate = CURDATE(), jobStatus = 'FINISHED', adminID = 1, active = 0 WHERE job.jobID = 8;
INSERT INTO finished_jobs (jobID, jobDescription) VALUES (8, 'Replaced switch');