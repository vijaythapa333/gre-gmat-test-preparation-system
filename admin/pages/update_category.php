<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Update Category</h2>
                        <span class="name">Category Title</span> 
                        <input type="text" name="category_title" value="Category Title" required="true" /> <br />
                        
                        <span class="name">Time Duration</span>
                        <input type="num" name="time_duration" value="Time Duration in Minutes" required="true" /><br />
                        
                        <span class="name">Is Active?</span>
                        <input type="radio" name="is_active" value="yes" /> Yes 
                        <input type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Update Category" class="btn-update" style="margin-left: 15%;" />
                        <button type="button" class="btn-delete">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->