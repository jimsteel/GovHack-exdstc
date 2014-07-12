/**
 * 
 */
package org.govhack.rf;

/**
 * @author ametke
 *
 */
public class EdgePair {
	private String src;
	private String tgt;
	
	public EdgePair() {
		
	}
	
	public EdgePair(String src, String tgt) {
		this.src = src;
		this.tgt = tgt;
	}
	
	public String getSrc() {
		return src;
	}
	public void setSrc(String src) {
		this.src = src;
	}
	public String getTgt() {
		return tgt;
	}
	public void setTgt(String tgt) {
		this.tgt = tgt;
	}
	
}
