<?php
class Model_user extends Model {
    public function in($login, $userpass) {
        $stmt = $this->dbh->execute("SELECT users.id FROM users WHERE users.login = '" . $login . "' AND users.pass = SHA1('" . $userpass . "')");
        if ($stmt->num_rows() > 0) return true;
        else return false;
    }
    public function edit($login) {
        $stmt = $this->dbh->execute("SELECT * FROM users WHERE users.login = '" . $login . "'");
        $row = $stmt->fetch_assoc();
        return $row;
    }
    public function usprint($id) {
        $stmt = $this->dbh->execute("SELECT users.id, users.login FROM users WHERE users.id = '" . $id . "'");
        if ($stmt->num_rows() > 0) {
            while ($row = $stmt->fetch_assoc()) {
                return $row;
            }
        }
    }
    public function validat_edit_pass($id, $userpass) {
        $stmt = $this->dbh->execute("SELECT id FROM users WHERE users.id = '" . $id . "' AND users.pass = SHA1('" . $userpass . "') ");
        if ($stmt->num_rows() > 0) return true;
        else return false;
    }
    public function idkey($login) {
        $stmt = $this->dbh->execute("UPDATE users SET users.key = SHA1(TIMESTAMP(NOW())) WHERE  users.login ='" . $login . "'");
        $stmt = $this->dbh->execute("SELECT users.id, users.key FROM users WHERE users.login = '" . $login . "'");
        if ($stmt->num_rows() > 0) {
            while ($row = $stmt->fetch_assoc()) {
                return $row;
            }
        }
    }
    public function validation_user($id, $key) {
        $stmt = $this->dbh->execute("SELECT users.id FROM users, groups  WHERE users.id = '" . $id . "' AND users.key = '" . $key . "' AND users.key <> 'NULL' AND users.group = groups.id");
        if ($stmt->num_rows() > 0) {
            return true;
        } //$stmt->num_rows() > 0
        else return false;
    }
    public function in_admin($login, $userpass) {
        $stmt = $this->dbh->execute("SELECT users.id FROM users, groups WHERE users.login =  '" . $login . "' AND users.pass =  SHA1('" . $userpass . "') AND users.group = groups.id AND groups.name = 'admin'");
        if ($stmt->num_rows() > 0) {
            return true;
        } //$stmt->num_rows() > 0
        else return false;
    }
    public function validation_admin($id) {
        $stmt = $this->dbh->execute("SELECT users.id FROM users, groups WHERE users.id =  '" . $id . "' AND users.group = groups.id AND groups.name = 'admin'");
        if ($stmt->num_rows() > 0) {
            return true;
        } //$stmt->num_rows() > 0
        else return false;
    }
    public function identification_user($id) {
        $stmt = $this->dbh->execute("SELECT users.id FROM users, groups WHERE users.id =  '" . $id . "' AND users.group = groups.id AND groups.name = 'user'");
        if ($stmt->num_rows() > 0) {
            return true;
        } //$stmt->num_rows() > 0
        else return false;
    }
    public function validation_login($login) {
        $stmt = $this->dbh->execute("SELECT * FROM users WHERE login = '" . $login . "'");
        if ($stmt->num_rows() > 0) {
            $data['error'] = ERROR_LOGIN;
            $data['result'] = false;
            return $data;
        } //$stmt->num_rows() > 0
        else {
            $data['result'] = true;
            return $data;
        }
    }
    public function update($id, $userpass) {
        $stmt = $this->dbh->execute("UPDATE users SET  users.pass =  SHA1('" . $userpass . "')  WHERE users.id= '" . $id . "';");
    }
    public function add($login, $userpass) {
        $stmt = $this->dbh->execute("INSERT INTO users VALUES (NULL, '" . $login . "', sha1('" . $userpass . "'), SHA1(TIMESTAMP(NOW())), (SELECT groups.id FROM groups WHERE name = 'user'))");
    }
    public function delete($login) {
        $stmt = $this->dbh->execute("DELETE FROM users WHERE login = '" . $login . "'");
    }
    public function exit_user($id) {
        $stmt = $this->dbh->execute("DELETE FROM room WHERE room.idUser = '" . $id . "'");
        $stmt = $this->dbh->execute("UPDATE users SET users.key = 'NULL ' WHERE users.id = '" . $id . "'");
    }
    public function all_users($page) {
        $stmt = $this->dbh->execute("SELECT * FROM users LIMIT " . $page . ", 10");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc();
            return $data;
        }
    }
    public function count_channels() {
        $stmt = $this->dbh->execute("SELECT count(*) AS count_channels FROM channels");
        if ($stmt->num_rows() > 0) {
            while ($row = $stmt->fetch_assoc()) {
                return $row;
            }
        }
    }
    public function all_channels($page) {
        $stmt = $this->dbh->execute("SELECT * FROM channels LIMIT " . $page . ", 10");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc();
            return $data;
        }
    }
    public function add_channels($ChannelName) {
        $stmt = $this->dbh->execute("INSERT INTO channels (id, name) VALUES (NULL, '" . $ChannelName . "');");
    }
    public function count_users() {
        $stmt = $this->dbh->execute("SELECT count(*) AS count_users FROM users");
        if ($stmt->num_rows() > 0) {
            while ($row = $stmt->fetch_assoc()) {
                return $row;
            }
        }
    }
    public function dell_channel($id) {
        $stmt = $this->dbh->execute("DELETE FROM channels WHERE channels.id = '" . $id . "' ");
        $stmt = $this->dbh->execute("DELETE FROM messages WHERE channel = '" . $id . "' ");
    }
    public function edit_channel($id, $name) {
        $stmt = $this->dbh->execute("UPDATE  channels  SET   channels.name  =  '" . $name . "' WHERE  channels.id ='" . $id . "';");
    }
    public function name_channel($id) {
        $stmt = $this->dbh->execute("SELECT  name  FROM channels   WHERE  channels.id ='" . $id . "';");
        if ($stmt->num_rows() > 0) {
            while ($row = $stmt->fetch_assoc()) {
                return $row;
            }
        }
    }
    public function valid_channel($id) {
        $stmt = $this->dbh->execute("SELECT  name  FROM channels   WHERE  channels.id ='" . $id . "';");
        if ($stmt->num_rows() > 0) {
            return true;
        } //$stmt->num_rows() > 0
        else return false;
    }
    public function all_messages($idChannel, $idUser) {
        $stmt = $this->dbh->execute("SELECT messages.id AS id, messages.text AS text, messages.channel AS channel, messages.date AS date, users.login AS login FROM messages, users WHERE messages.from = users.id AND messages.channel = '" . $idChannel . "' AND (messages.recipient = '0' OR messages.recipient='" . $idUser . "' OR messages.from='" . $idUser . "') ORDER BY  messages.id DESC ");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc(); //var_dump($data[0]);die();
            return $data;
        }
    }
    public function add_message($id, $idChannel, $message, $recipient = 0) {
        $stmt = $this->dbh->execute("INSERT INTO messages (id, text, channel, messages.from, recipient, date) VALUES (NULL, '" . $message . "', '" . $idChannel . "', '" . $id . "', '" . $recipient . "', CURRENT_TIMESTAMP);");
    }
    public function dell_message($id) {
        $stmt = $this->dbh->execute("SELECT  * FROM messages WHERE  messages.id ='" . $id . "';");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetch_assoc();
            $this->dbh->execute("DELETE FROM messages WHERE messages.id = '" . $id . "' ");
            return $data;
        }
    }
    public function save_message($id, $message) {
        $stmt = $this->dbh->execute("SELECT  * FROM messages WHERE  messages.id ='" . $id . "'");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetch_assoc();
            $this->dbh->execute("UPDATE  messages SET text =  '" . $message . "' WHERE  messages.id = '" . $id . "' ");
            return $data;
        }
    }
    public function message($id) {
        $stmt = $this->dbh->execute("SELECT * FROM messages WHERE messages.id ='" . $id . "'");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetch_assoc();
            return $data;
        }
    }
    public function room($idUser, $idChannel) {
        $this->dbh->execute("INSERT INTO room (idUser, idChannel ) VALUES (  '" . $idUser . "', '" . $idChannel . "') ON DUPLICATE KEY UPDATE idChannel = '" . $idChannel . "'");
        $stmt = $this->dbh->execute("SELECT  DISTINCT  users.id AS idInRoom, users.login AS loginInRoom FROM room, users, channels WHERE room.idUser = users.id AND room.idChannel = channels.id AND room.idChannel ='" . $idChannel . "' AND  room.idUser != '" . $idUser . "' ");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc();
            return $data;
        }
        return $data;
    }
    public function messages_ajax($id, $message) {
        //SELECT messages.id AS id, messages.text AS text, messages.channel AS channel, messages.date AS date, users.login AS login FROM messages, users, room WHERE messages.from = users.id AND messages.channel = room.idChannel AND users.id = room.idUser AND (messages.recipient = '0' OR messages.recipient='21' OR messages.from='21') ORDER BY  messages.id DESC
        $stmt = $this->dbh->execute("SELECT messages.id AS id, messages.text AS text, messages.channel AS channel, messages.date AS date, users.login AS login, users.recipient AS recipient FROM messages, users, room  WHERE messages.from = users.id AND messages.channel = room.idChannel AND users.id = room.idUser AND  messages.id > '" . $message . "' AND (messages.recipient = '0' OR messages.recipient='" . $id . "' OR messages.from='" . $id . "') ORDER BY  messages.id DESC");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc();
            return $data;
        }
        return null;
    }
    public function room_ajax($id) {
        $stmt = $this->dbh->execute("SELECT users.id AS id, users.login AS login FROM users, room WHERE users.id = room.idUser AND users.id <> '" . $id . "'");
        if ($stmt->num_rows() > 0) {
            $data = $stmt->fetchall_assoc();
            return $data;
        }
        return null;
    }
}
?> 
