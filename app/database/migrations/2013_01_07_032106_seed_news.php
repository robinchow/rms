<?php

class SeedNews {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('news')->insert(array(
			'title' => "AD and AP,Website Redesign",
		    'post'  => "----------------------------------------------- 
Assistant Director and Producer 
----------------------------------------------- 
We’re seeking applications for the positions of assistant director and assistant producer. 
If you think you’re suited to one of these top jobs, and want to join in and help Exec this year,you can apply for consideration. 
Just send a reply to newexec@cserevue.org.au and make sure to include your name and what position you’re interested in. 
Applications will be open for the next week, closing on next Monday the 26th.

----------------------------------------------- 
Website Redesign Committee 
----------------------------------------------- 
We’re also looking for expressions of interest to join a committee to rebuild and redesign the revue website. 
Don’t feel like you need to know how to code! We’re also looking for designers, coordinators and people with cool ideas. 
If you’re interested, then reply to newexec@cserevue.org.au saying so. We’ll be putting the committee together over the next month. 

Thanks Guys! 
Your Uber Keen New Exec 
Stevebob, Jack, Jigar, Maddi, Matt, Sam and Pierre",
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('news')->delete();
	}

}