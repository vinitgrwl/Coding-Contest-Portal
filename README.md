Coding-Contest-Portal
=====================

This is the coding contest portal based on database.

Abstract:
The purpose of this project is to make an efficient database for conducting online coding
contests where teams can register and are able to view various questions, related tutorials,
ask doubts regarding the questions ,upload their solutions and test whether they are correct
or not. The application would help students to improve their coding skills and make learning
a fun experience. Database is the preferred medium to store the data because it helps in
maintaining the logs efficiently without any redundancy and wastage of space, can handle
large amount of data ,maintain consistency and it is much easier to access a particular
information as desired using MYSQL language.
Relational tables:
1.Team:
uid , pcode , team_size , total_score
Primary Key: uid
2.Users:
uname , rollno , institute , emaild , tid
Primary key: emailid
Foreign key :tid refer to uid of Team
3.Problems:
qcode, question, in_file, solfile, credits, topic, date, title
Primary Key: qcode
4.Answers:
aid,team_id, quescode, ans_status, score, datetime, lang
Primary Key: aid
Foreign key: team_id refers uid of team
quescode refers qcode of problems.
5.Comments:
cid, quescode, team_id, comment
Primary Key: cid
Foreign key: team_id refers uid of team
quescode refers qcode of problems.
6.Languages:
qcode, lang
primary key: qcode,lang
foreign key: qcode refer qcode of problems
7.Tutorial:
topic, file
primary key: topic
foreign key: topic refer topic of problems.

Constraint :
1. The ‘lang’attribute oftable‘languages’and‘answers’can have only c,cpp,java,python,perl,php.
2. Trigger :
1. After the insertion of every answer in ‘answers’ table the ‘total_score’ in table ‘team’ is updated by adding the
score obtained for the answer to the existing total score.
The problem was realized into a conceptual model and E-R diagram was created which
was converted into the required relations. The relations had be to developed to minimize
redundancy and such that it obeyed the highest level of normal form so as to make an
efficient use of the properties of the database management system.

Modules:
Registration module
New teams need to register first and have to specify a unique team id which is not already
taken by any other team previously. Taking the team id as the primary key,all team related
information is inserted in the table named ‘team’.
For each team, all the information related to all the users which are the members of that
team is inserted in the table ‘users’. For each user, its email-id is taken as its primary key.
Login module
When the users logs in , a tuple is searched in the table ‘team’ having the team id and
password same as given by the team. If it is found, login process is completed.
Viewing questions
When the user logs in, he can view all the problems which have been uploaded till date
which are displayed by selecting from the table ‘problem’ along with the languages
allowed for a particular problem by selecting from the ‘languages’ table. From those
questions, he can upload the solution of any if he wants.
Submitting questions
When the user uploads his solution to a particular problem statement his answer is
compiled and the status of his answer (accepted, wrong answer , compilation error) is
inserted in the ‘answers’ table with the timestamp of entrance. According to the correctness
of the answer each answer is allocated score and whenever an answer is inserted into the
table ‘answers’ it triggers to update the total score of each team in the table ‘team’.
Viewing status
User can view his own status of what questions he has uploaded till now and what is their
status (accepted, wrong answer, compilation error) and the number of attempts of each
question by counting the number of entries of each team for a particular question and
answer status and is selected and displayed.
Viewing statistics
User can view the statistics of other teams, what questions are being tried and accepted by
selecting the entries from the table ‘answers’ and displaying them in the order from latest
entry to the oldest.
Viewing score
User can view the score of all the teams by selecting from table ‘team’ and can also view
the question code for the problems which are accepted by selecting those entries from table
‘answers’ which have status accepted for a particular team.
Searching previous questions module
Users can access all the previously uploaded questions based on different criteria.
Here the criteria can be question code of the question, credits allotted to the questions,
language of the question, maximum accepted questions, date of the contest and the topic of
the question.
User can select one or more than one criteria.
• Based on the question code
Table ‘problems’ is searched for the question code entered by the user and the
selected tuple is displayed.
• Based on the date of contest
Table ‘problems’ is searched for the date of the contest entered by the user and the
selected tuples are displayed.
• Based on the credits allotted
Table ‘problems’ is searched for the credits allocated entered by the user and the
selected tuples are displayed.
• Based on the language of the question
The table ‘languages’ is searched on the basis of the language entered by the user .
then the table ‘problems’ is searched having the same qcode as of the previously
selected tuples of the table ‘languages’ using nested query.
• Based on the maximum accepted answer
Tuples having the status ‘accepted’ are selected from the table ‘answers’. Selected
tuples are grouped by the qcode and then they are arranged in the decreasing order
of their count. According to the qcode of the selected tuples , table ‘problems’ is
searched and the relevant data is displayed.
• Based on multiple criteria
The union of the above queries is done for displaying the required data.
Searching tutorial module
For better learning, users can also access various tutorials available on various topics.
Based on the topic entered by the user , table ‘tutorial’ is searched and all the entries having
the same topic is displayed.
Special privileges for the Admin
If the admin logs in , he can access following pages:
• For uploading more questions: Admin can insert more questions into the database
and the problem statement along with its title, credits, topic, in-file, sol-file into the
table ‘problems’ taking the qcode as primary key. Also the allowed languages for a
particular question is inserted into the table ‘languages’ taking both language and
question code as primary key.
• For uploading tutorials: Admin can upload tutorials for a particular topic whose
question has being uploaded into the database. The topic and tutorial is inserted into
the table ‘tutorials’ with its id as primary key.
• Viewing information of all teams: Admin can view all information of a particular
team by selecting from table ‘team’ and all the users of a particular team by
selecting from the table ‘users’.
Conclusion :
The database management system is used instead of any other technique because it can handle large amount of data very
efficiently and when multiple users log in it maintains the consistency of data. It helps to reduce redundancy and wastage of storage area.

