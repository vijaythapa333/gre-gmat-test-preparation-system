<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Add Category</h2>
                        <span class="name">Category Title</span> 
                        <input type="text" name="category_title" placeholder="Category Title" required="true" /> <br />
                        
                        <span class="name">Time Duration</span>
                        <input type="num" name="time_duration" placeholder="Time Duration in Minutes" required="true" /><br />
                        
                        <span class="name">Is Active?</span>
                        <input type="radio" name="is_active" value="yes" /> Yes 
                        <input type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Add Category" class="btn-add" style="margin-left: 15%;" />
                        <button type="button" class="btn-delete">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->