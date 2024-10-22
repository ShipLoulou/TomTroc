<div class="wrapperPage">
    <section class="message">
        <div class="left containerMessageDisplayNone">
            <h2>Messagerie</h2>
            <?php foreach ($listInterlocutor as $interlocutor) { ?>
                <?php foreach ($users as $user) {
                    if ($user->getUserId() === $interlocutor['interlocutorId']) { ?>
                    <a href="index.php?action=messaging&id=<?= $user->getUserId() ?>&conv=<?= $interlocutor['conversationId'] ?>#scroolBottom">
                        <figure <?php if ($user->getUserId() === $interlocutorId) {
                            echo "class='active'";
                        } ?>>
                            <img
                            src="<?= $user->getProfilePicture() ?>"
                            alt="<?= $user->getPseudo() ?>"
                            />
                            <figcaption>
                            <div class="up">
                                <h3><?= $user->getPseudo() ?></h3>
                                <?php
                                    // Date d'envoie du dernier message.
                                    $dateLastMessage= new DateTime($interlocutor['lastMessage']->getSendingDatetime());
                                    $onlyDateLastMessage= $dateLastMessage->format('Y-m-d');

                                    // Date actuelle.
                                    $currentDate = new DateTime();
                                    $onlyDateCurrentDate= $currentDate->format('Y-m-d');

                                    if ($onlyDateLastMessage === $onlyDateCurrentDate) {
                                        $date= $dateLastMessage->format('H:i');
                                    } else {
                                        $date= $dateLastMessage->format('d.m');
                                    }
                                    echo "<div class='datetime'>{$date}</div>";
                                ?>
                            </div>
                            <?php
                        echo "<p>{$interlocutor['lastMessage']->getContent()}</p>";
                        ?>
                            </figcaption>
                        </figure>
                    </a>
                <?php }}} ?>
            </div>
            <div class="right">
            <!-- Balise <a> est utilisé uniquement sur mobile -->
            <a href="#" class="return">&lt;- retour</a>
            <div class="user">
                <img
                src="<?= $infoInterlocutor->getProfilePicture() ?>"
                alt="<?= $infoInterlocutor->getPseudo() ?>"
                />
                <h3><?= $infoInterlocutor->getPseudo() ?></h3>
            </div>
            <div class="messageArea">
                <div class="scrool">
                    <?php
                        foreach ($messagesByConversation as $message) { ?>
                        <div <?php if ($message->getUserId() === $infoInterlocutor->getUserId()) {
                            echo "class='messageContact'";
                        } else {
                            echo "class='messageUser'";
                        } ?>>
                            <div class="info">
                                <img
                                    <?php if ($message->getUserId() == $infoInterlocutor->getUserId()) { ?>
                                        src="<?= $infoInterlocutor->getProfilePicture() ?>"
                                        alt="<?= $infoInterlocutor->getPseudo() ?>"

                                        <?php } else { ?>
                                        src="<?= $infoMyUser->getProfilePicture() ?>"
                                        alt="<?= $infoMyUser->getPseudo() ?>"
                                    <?php } ?>
                                />
                                <p><?= $message->getSendingDatetime() ?></p>
                            </div>
                            <p class="contentMessage">
                            <?= $message->getContent() ?>
                            </p>
                        </div>
                    <?php } ?>
                    <div id='scroolBottom'></div>
                </div>
            </div>
            <div class="editMessage">
                <form action="#" method="post">
                    <input type="text" id="formulaireSend" name="formulaireSend" value="ok" class="displayNone" aria-label="Tapez votre message ici">
                    <input type="text" name="messageContent" id="messageContent" placeholder="Tapez votre message ici" aria-label="Tapez votre message ici"/>
                    <input class="btn-style-1" type="submit" value="Envoyer" />
                </form>
            </div>
        </div>
    </section>
</div>