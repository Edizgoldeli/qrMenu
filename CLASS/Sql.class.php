<?php
class Sql
{
    private $selectedId;

    public function updateStatus($selectedId)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE menu SET status = 1 WHERE id = :selectedId");
        $stmt->bindParam(':selectedId', $selectedId, PDO::PARAM_INT);
        $stmt->execute();

        // Set the rest of the statuses to 0
        $stmt = $conn->prepare("UPDATE menu SET status = 0 WHERE id != :selectedId");
        $stmt->bindParam(':selectedId', $selectedId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function showCategoriesOrder($selectedId)
    {
        global $conn;
        $stmt = $conn->query("SELECT ID, categoryName from category WHERE menuID = $selectedId", PDO::FETCH_ASSOC);
        foreach ($stmt as $data) {

            $categoryID = $data['ID'];
            $categoryName = $data['categoryName'];
            echo $categoryID . " " . $categoryName . "<br>";
        }

    }
    public function updateCategoriesOrder()
    {
        if (isset($_POST['project_ids'])) {
            $priorities = $_POST['project_ids'];
            $priorities = explode(',', $priorities);
            $i = 0;

            // Debug: Print the priorities array to check the IDs
            error_log(print_r($priorities, true));
            $i = 1;
            foreach ($priorities as $id) {
                global $conn;

                // Debug: Print the current priority and ID
                error_log("Updating ID: $id with priority: $i");

                $stmt = $conn->prepare("UPDATE category SET priority = ? WHERE ID = ?");
                $stmt->bindParam(1, $i, PDO::PARAM_INT);
                $stmt->bindParam(2, $id, PDO::PARAM_INT);
                $stmt->execute();

                $i++;
            }
        }
    }


    public function rearrangeCategoriesOrder($selectedId)
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#sortable").sortable();

                $("#savebtn").click(function (e) {
                    e.preventDefault();  // Prevent the default form submission
                    var array = [];
                    $.each($('#sortable').find('li'), function () {
                        array.push($(this).data('id'));
                    })
                    $("#project_ids").val(array.toString());
                    // Use AJAX to submit the form
                    $.ajax({
                        type: "POST",
                        url: $("#form").attr("action"),  // The URL to send the data to
                        data: $("#form").serialize(),  // Serialize the form data
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                    
                });
            });
        </script>
        <ul id="sortable">
            <?php
            global $conn;
            $count = 0;
            $stmt = $conn->query("SELECT ID, categoryName, priority from category WHERE menuID = $selectedId ORDER BY priority ASC", PDO::FETCH_ASSOC);
            foreach ($stmt as $data) {
                $categoryName = $data['categoryName'];
                $categoryID = $data['ID'];
                
                ?>
                <li data-id="<?php echo $categoryID; ?>"><?php echo $categoryName; ?></li>
                <?php
                $count++;
            }
            ?>
        </ul>
        <form action="" method="POST" id="form">
            <input type="hidden" name="project_ids" id="project_ids" />
            <?php    if($count > 0 ){?><button id="savebtn">Güncelle</button><?php }?>
        </form>
        <?php
    }




}