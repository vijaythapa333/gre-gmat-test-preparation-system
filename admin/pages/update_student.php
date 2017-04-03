<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Update Student</h2>
                        <span class="name">First Name</span> 
                        <input type="text" name="first_name" value="First Name" required="true" /> <br />
                        
                        <span class="name">Last Name</span>
                        <input type="text" name="last_name" value="Last Name" required="true" /><br />
                        
                        <span class="name">Email</span>
                        <input type="email" name="email" value="Email Address" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" value="Username" required="true" /><br />
                        
                        <span class="name">Password</span>
                        <input type="text" name="password" value="Password" /><br />
                        
                        <span class="name">Contact</span>
                        <input type="tel" name="contact" value="Contact Number" /><br />
                        
                        <span class="name">Gender</span>
                        <input type="radio" name="gender" value="male" /> Male 
                        <input type="radio" name="gender" value="female" /> Female 
                        <input type="radio" name="gender" value="other" /> Other
                        <br />
                        
                        <span class="name">Faculty</span>
                        <select name="faculty">
                            <option value="GRE">GRE</option>
                            <option value="GMAT">GMAT</option>
                            <option value="TOEFL">TOEFL</option>
                        </select>
                        <br />
                        
                        <span class="name">Is Active?</span>
                        <input type="radio" name="is_active" value="yes" /> Yes 
                        <input type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Update Student" class="btn-update" style="margin-left: 15%;" />
                        <button type="button" class="btn-delete">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->