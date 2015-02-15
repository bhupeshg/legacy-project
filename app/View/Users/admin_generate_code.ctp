<script type="text/javascript">
    function code() {
        $.ajax({
            url: "generate_code",
            success: function (result) {
                $("#new_code").html(result);
            },
            error: function () {
                alert("Code can't be generated at the moment. please try again");
            }
        });
    }
</script>
<?php
/**
 * @var $this View
 */
?>
<div class="col-md-9">
    <?php echo $this->Html->link('Generate randon Code', '#', array('class' => 'generate_code', 'onClick' => 'code()'))?>
</div>
<!-- end col md 9 -->
<div class="col-md-12">
    Registration Link: <?php echo $this->Html->link('', '/users/register')?>
    <span id="new_code"></span>
</div>
<!-- end col md 9 -->
