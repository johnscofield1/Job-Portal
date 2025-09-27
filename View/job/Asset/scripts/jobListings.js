const jobs = [
  {
    title: "Frontend Developer",
    company: "TechSoft Ltd.",
    location: "Dhaka, Bangladesh",
    salary: "৳40,000/month",
    description: "Work with HTML, CSS, JS frameworks. Good UI sense preferred."
  },
  {
    title: "Backend Engineer",
    company: "CodeBase Inc.",
    location: "Remote",
    salary: "$1500/month",
    description: "Node.js, Express, MongoDB. REST APIs development required."
  },
  {
    title: "UI/UX Designer",
    company: "Creative Labs",
    location: "Chittagong, Bangladesh",
    salary: "৳35,000/month",
    description: "Create design prototypes, user flows, wireframes in Figma/Adobe XD."
  }
];

const container = document.getElementById("job-container");

jobs.forEach(job => {
  const card = document.createElement("div");
  card.style = `
    background: white;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 8px;
    text-align: left;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  `;
  card.innerHTML = `
    <h3 style="color: #810513; margin-top: 0;">${job.title}</h3>
    <p><strong>Company:</strong> ${job.company}</p>
    <p><strong>Location:</strong> ${job.location}</p>
    <p><strong>Description:</strong> ${job.description}</p>
    <p><strong>Salary:</strong> ${job.salary}</p>
    <button style="
      padding: 10px 20px; 
      background-color: #810513; 
      color: white; 
      border: none; 
      border-radius: 4px;
      margin-top: 10px;
    " onclick="alert('Application process started')">Apply</button>
  `;
  container.appendChild(card);
});
