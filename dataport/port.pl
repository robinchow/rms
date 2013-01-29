#!/usr/bin/perl
use strict;
use DBI;

sub connect_to_db($$$$);


my $from_dbh = connect_to_db("teletran2.cse.unsw.edu.au",
                             "cserevue",
                             "cserevue",
                             "One five the team");

my $to_dbh = connect_to_db("localhost",
                             "rms",
                             "rms",
                             "rms");

my $sql;
my $sth;

sub port {
# port users and profiles
$sql = qq{
    SELECT email, fname, lname, username, mobile, home, work, arc_member, start_year,
           gender, program, created, dob, email_privacy, student_id
    FROM member
};
$sth = $from_dbh->prepare($sql);
$sth->execute() or die "bad qry $sql";
while (my $ref = $sth->fetchrow_hashref()) {
    print "porting into 'users' $$ref{'email'}\n";
    my $insert_sql = <<EOF
        INSERT INTO users(email, reset_password_hash, admin)
        values('$$ref{'email'}', '123', 0)
EOF
;
    my $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute() or die "bad qry $insert_sql";


    my $user_id_sql = "SELECT id FROM users WHERE email = '$$ref{'email'}'";
    my $user_id_sth = $to_dbh->prepare($user_id_sql);
    $user_id_sth->execute() or die "bad qry $user_id_sql\n";
    
    my $user_id = $user_id_sth->fetchrow_array();
    
    my $phone = $$ref{mobile};
    if ($phone eq "") {
        $phone = $$ref{home};
    }
    if ($phone eq "") {
        $phone = $$ref{work};
    }

    if (!$$ref{start_year}) {
        $$ref{start_year} = "NULL";
    }

    if (!$$ref{dob}) {
        $$ref{dob} = "NULL";
    }

    if (!$$ref{arc_member}) {
        $$ref{arc_member} = 0;
    }

    $insert_sql = <<EOF
        INSERT INTO profiles (full_name, display_name, gender, dob, privacy,
                              phone, program, student_number, start_year,
                              arc, user_id)
        VALUES ('$$ref{fname} $$ref{lname}', '$$ref{username}', '$$ref{gender}',
                $$ref{dob}, '$$ref{email_privacy}', '$phone', '$$ref{program}',
                '$$ref{student_id}', $$ref{start_year}, $$ref{arc_member},
                $user_id)
EOF
;
    $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute() or die "bad qry $insert_sql";


}

# port teams
$sql = qq{
    SELECT name, mailing_list, public, description
    FROM team
};
$sth = $from_dbh->prepare($sql);
$sth->execute() or die "bad qry $sql";


while (my $ref = $sth->fetchrow_hashref()) {
    if ($$ref{mailing_list} =~ m/(producers|secretary|directors|arc|treasurer|exec)/) {
        next;
    }
    print "$$ref{name}\n";
    my $privacy = 1 - $$ref{public};
    my $insert_sql = <<EOF
        INSERT INTO teams (name, alias, privacy, description)
        VALUES ('$$ref{name}', '$$ref{mailing_list}', $privacy, ?)
EOF
;
    my $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute($$ref{description}) or die "bad qry $insert_sql";
    
}

# user_year
$sql = qq{
    SELECT member.id as mem_id, email, year
    FROM member_year JOIN member ON (member_year.member = member.id)
};
$sth = $from_dbh->prepare($sql);
$sth->execute() or die "bad qry $sql";
while (my $ref = $sth->fetchrow_hashref()) {
    print "$$ref{mem_id}\t$$ref{email}\t$$ref{year}\n";
    my $lookup_sql = "SELECT id FROM users WHERE email = '$$ref{email}'";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $user_id = $lookup_sth->fetchrow_array();
    $lookup_sql = "SELECT id FROM years WHERE year = $$ref{year}";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $year_id = $lookup_sth->fetchrow_array();
    print "$user_id - $year_id\n";
    my $insert_sql = qq{
        INSERT INTO user_year (user_id, year_id)
        VALUES ($user_id, $year_id)
    };
    my $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute() or die "bad qry $insert_sql";
}

# team_year
$sql = qq{
    SELECT mailing_list, year
    FROM team_year JOIN team ON (team_year.team = team.id)
};
$sth = $from_dbh->prepare($sql);
$sth->execute() or die "bad qry $sql";
while (my $ref = $sth->fetchrow_hashref()) {
    print "$$ref{mailing_list}\t$$ref{year}\n";
    my $lookup_sql = "SELECT id FROM teams WHERE alias = '$$ref{mailing_list}'";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $team_id = $lookup_sth->fetchrow_array();
    if (!$team_id) {
        next;
    }
    $lookup_sql = "SELECT id FROM years WHERE year = $$ref{year}";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $year_id = $lookup_sth->fetchrow_array();
    print "$team_id - $year_id\n";
    my $insert_sql = qq{
        INSERT INTO team_year (team_id, year_id)
        VALUES ($team_id, $year_id)
    };
    my $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute() or die "bad qry $insert_sql";
}

# team_user
$sql = qq{
    SELECT mailing_list, email, year, level
    FROM team_member JOIN member ON (team_member.member = member.id)
                     JOIN team   ON (team_member.team = team.id)
};
$sth = $from_dbh->prepare($sql);
$sth->execute() or die "bad qry $sql";
while (my $ref = $sth->fetchrow_hashref()) {
    print "$$ref{mailing_list}\t$$ref{email}\t$$ref{year}\n";
    my $lookup_sql = "SELECT id FROM users WHERE email = '$$ref{email}'";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $user_id = $lookup_sth->fetchrow_array();
    $lookup_sql = "SELECT id FROM teams WHERE alias = '$$ref{mailing_list}'";
    $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $team_id = $lookup_sth->fetchrow_array();
    if (!$team_id) {
        next;
    }
    $lookup_sql = "SELECT id FROM years WHERE year = $$ref{year}";
    my $lookup_sth = $to_dbh->prepare($lookup_sql);
    $lookup_sth->execute() or die "bad qry $lookup_sql";
    my $year_id = $lookup_sth->fetchrow_array();
    
    my $status = "member";
    if ($$ref{level} == 1) {
        $status = "interest";
    } elsif ($$ref{level} == 3) {
        $status = "head";
    }

    my $insert_sql = qq{
        INSERT INTO team_user (team_id, user_id, year_id, status)
        VALUES ($team_id, $user_id, $year_id, '$status')
    };
    my $insert_sth = $to_dbh->prepare($insert_sql);
    $insert_sth->execute() or die "bad qry $insert_sql";
}
}

sub port_exec($) {
    my $position = shift; 
    print "$position:\n";
    $sql = qq{
        SELECT id
        FROM executives
        WHERE position = '$position'
    };
    $sth = $to_dbh->prepare($sql);
    $sth->execute() or die "bad qry $sql";
    my $pos_id = $sth->fetchrow_array();

    $sql = qq{
        SELECT email, year
        FROM team_member JOIN team ON team.id = team_member.team
                         JOIN member ON member.id = team_member.member
        WHERE team.name = '$position'
    };
    $sth = $from_dbh->prepare($sql);
    $sth->execute() or die "bad qry $sql";
    while (my $ref = $sth->fetchrow_hashref()) {
        print "$$ref{email} $$ref{year}\n";
        my $lookup_sql = "SELECT id FROM users WHERE email = '$$ref{email}'";
        my $lookup_sth = $to_dbh->prepare($lookup_sql);
        $lookup_sth->execute() or die "bad qry $lookup_sql";
        my $user_id = $lookup_sth->fetchrow_array();
        $lookup_sql = "SELECT id FROM years WHERE year = $$ref{year}";
        my $lookup_sth = $to_dbh->prepare($lookup_sql);
        $lookup_sth->execute() or die "bad qry $lookup_sql";
        my $year_id = $lookup_sth->fetchrow_array();
        my $insert_sql = qq{
            INSERT INTO executive_user (executive_id, user_id, year_id)
            VALUES ($pos_id, $user_id, $year_id)
        };
        my $insert_sth = $to_dbh->prepare($insert_sql);
        $insert_sth->execute() or die "bad qry $insert_sql";  

    }
}

port();
port_exec("Producers");
port_exec("Directors");
port_exec("Secretary");
port_exec("Treasurer");
port_exec("Arc Delegate");

$from_dbh->disconnect() or die $!;
$to_dbh->disconnect() or die $!;

sub connect_to_db($$$$) {
    my ($hostname, $username, $database, $password) = @_;

    print "Connecting to $hostname:$database\n";

    my $dbh = DBI->connect("dbi:mysql:$database:$hostname",
                       "$username",
                       "$password",
                       {RaiseError => 0,
                        PrintError => 0})
            or die "Couldn't connect to database";

    return $dbh;
}


