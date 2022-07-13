<?php if(!empty($users)):?>
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            
                                            <th>Lesson</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($users as $lesson):?>
                                        <tr class='clickable-row' data-href="<?= site_url('auth/');?>">
                                            <td><?= $lesson->id;?></td>
                                            <td><?= $lesson->code;?></td>
                                            <td><?= $lesson->active;?></td>
                                        </tr>
                                    <?php endforeach;?>

                                    </tbody>
                                </table>
                            <?php else:?>
                            <?php endif;?>