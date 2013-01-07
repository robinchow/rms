<?php

class Seed_Faqs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('faqs')->insert(array(
		    'question'  => 'What is a CSE?',
		    'answer'  => 'The School of Computer Science & Engineering, part of the Faculty of Engineering.',
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'What is a Revue?',
		    'answer'  => "A revue is a sketch comedy show, much in the same vein as such acts as Monty Python, The Late Show and Saturday Night Live. Sketch comedy consists of a series of short comedy scenes (aka 'sketches').",
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'When does the CSE Revue run?',
		    'answer'  => 'The actual show will be running over 4 nights this year, from the 25 - 28 September (Week 10, Session 2).',
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'How/where can I get tickets to see the show?',
		    'answer'  => 'Tickets will be available starting from Week 8 (Monday, 10th of September)<br><br>When tickets go on sale, you can book online using our website, buy them in person at our Sales Desk (located at UNSW, Kensington Campus) or you can get them at the door on a show night. It is highly recommended you book beforehand to ensure you get a good seat and to save time.',
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'Where is this K17 building I keep hearing about?',
		    'answer'  => 'The K17 building is the home of the School of Computer Science and Engineering. It is located at the map co-ordinates, K-17',
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'I missed Membership Day but I still want to sign up.',
		    'answer'  => 'There is an online signup form here.',
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'Do I need to be a CSE student to join?',
		    'answer'  => "No. You don't even have to be a student at all. Although we try to keep the CSE feel we encourage anyone to join us.",
		));
		DB::table('faqs')->insert(array(
		    'question'  => "I don't have much time to commit but I would like to help out. Is there still something I can do?",
		    'answer'  => "While you need a lot of time to do things like Cast and to a degree, Tech Crew, you can still sign up and be involved with Promotions or Front of House. This way you only need to commit a few hours on a couple of days to the revue, but you'll still have the opportunity to meet a lot of new friends, and belong to the show.",
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'Can I do more than one revue in the year?',
		    'answer'  => "Indeed you can. There are quite a few people who do Med Revue in Session 1 and CSE Revue in Session 2, as it fits quite conveniently. Since CSE and Law Revue run in the same session, its impossible to do cast in both. However, it is possible to do for example, cast in one and tech in another (just don't try writing a thesis at the same time).",
		));
		DB::table('faqs')->insert(array(
		    'question'  => 'Why is your Membership Day so long before the revue?',
		    'answer'  => 'While people from teams such as Tech and Wellbeing may not start until a few weeks before the revue, we have other teams working from very early on such as VFX, Design, Promotions, etc. But other than that, CSE Revue is very much a social experience with events such as BBQs, movie nights, roadtrips, LANs and parties every few weeks. Signing people up this early means there will be plenty more fun to be had before the hard work starts :)',
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('faqs')->delete();
	}

}